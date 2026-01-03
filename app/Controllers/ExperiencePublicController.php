<?php

namespace App\Controllers;

use App\Models\WorkExperienceModel;
use CodeIgniter\Controller;

class ExperiencePublicController extends BaseController
{
    protected $WorkExperienceModel;

    public function __construct()
    {
        $this->WorkExperienceModel = new WorkExperienceModel();
    }

    /**
     * Halaman publik untuk menampilkan semua work experience
     */
    public function index()
    {
        $data = [
            'work_experiences' => $this->WorkExperienceModel->getWorkExperiences('start_date', 'DESC'),
            'title' => 'Pengalaman Kerja',
            'meta_description' => 'Lihat pengalaman kerja dan perjalanan karir profesional saya'
        ];

        return view('work-experiences/experience', $data);
    }

    /**
     * Detail work experience untuk publik
     */
    public function detail($id)
    {
        $workExperience = $this->WorkExperienceModel->getWorkExperienceById($id);

        if (!$workExperience) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengalaman kerja tidak ditemukan');
        }

        $data = [
            'work_experience' => $workExperience,
            'title' => $workExperience['position'] . ' - ' . $workExperience['company_name'],
            'meta_description' => 'Detail pengalaman kerja sebagai ' . $workExperience['position'] . ' di ' . $workExperience['company_name']
        ];

        return view('work-experiences/detail-work-experience', $data);
    }

    /**
     * Get work experiences as JSON (untuk AJAX atau API)
     */
    public function api()
    {
        $experiences = $this->WorkExperienceModel->getWorkExperiences('start_date', 'DESC');

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $experiences,
            'total' => count($experiences)
        ]);
    }

    /**
     * Get work experience by company (filter by company)
     */
    public function byCompany($companyName)
    {
        $experiences = $this->WorkExperienceModel
            ->like('company_name', $companyName, 'both')
            ->orderBy('start_date', 'DESC')
            ->findAll();

        foreach ($experiences as &$experience) {
            $experience['documentation_images'] = json_decode($experience['documentation_images'], true) ?? [];
            $experience['skills_used'] = json_decode($experience['skills_used'], true) ?? [];
            $experience['period'] = $this->calculatePeriod($experience['start_date'], $experience['end_date']);
        }

        $data = [
            'work_experiences' => $experiences,
            'company_name' => $companyName,
            'title' => 'Pengalaman di ' . $companyName
        ];

        return view('work-experiences/experience', $data);
    }

    /**
     * Get current work experiences (yang masih aktif)
     */
    public function current()
    {
        $experiences = $this->WorkExperienceModel
            ->where('is_current', 1)
            ->orderBy('start_date', 'DESC')
            ->findAll();

        foreach ($experiences as &$experience) {
            $experience['documentation_images'] = json_decode($experience['documentation_images'], true) ?? [];
            $experience['skills_used'] = json_decode($experience['skills_used'], true) ?? [];
            $experience['period'] = $this->calculatePeriod($experience['start_date'], $experience['end_date']);
        }

        $data = [
            'work_experiences' => $experiences,
            'title' => 'Pekerjaan Saat Ini',
            'is_current' => true
        ];

        return view('work-experiences/experience', $data);
    }

    /**
     * Search work experiences
     */
    public function search()
    {
        $keyword = $this->request->getGet('q');

        if (!$keyword) {
            return redirect()->to('/experience');
        }

        $experiences = $this->WorkExperienceModel
            ->groupStart()
            ->like('company_name', $keyword, 'both')
            ->orLike('position', $keyword, 'both')
            ->orLike('description', $keyword, 'both')
            ->orLike('job_description', $keyword, 'both')
            ->groupEnd()
            ->orderBy('start_date', 'DESC')
            ->findAll();

        foreach ($experiences as &$experience) {
            $experience['documentation_images'] = json_decode($experience['documentation_images'], true) ?? [];
            $experience['skills_used'] = json_decode($experience['skills_used'], true) ?? [];
            $experience['period'] = $this->calculatePeriod($experience['start_date'], $experience['end_date']);
        }

        $data = [
            'work_experiences' => $experiences,
            'keyword' => $keyword,
            'title' => 'Pencarian: ' . $keyword
        ];

        return view('work-experiences/experience', $data);
    }

    /**
     * Get experiences by skill
     */
    public function bySkill($skill)
    {
        $allExperiences = $this->WorkExperienceModel->findAll();
        $filteredExperiences = [];

        foreach ($allExperiences as $experience) {
            $skills = json_decode($experience['skills_used'], true) ?? [];

            // Check if skill exists in skills_used array (case insensitive)
            foreach ($skills as $expSkill) {
                if (stripos($expSkill, $skill) !== false) {
                    $experience['documentation_images'] = json_decode($experience['documentation_images'], true) ?? [];
                    $experience['skills_used'] = $skills;
                    $experience['period'] = $this->calculatePeriod($experience['start_date'], $experience['end_date']);
                    $filteredExperiences[] = $experience;
                    break;
                }
            }
        }

        // Sort by start_date DESC
        usort($filteredExperiences, function ($a, $b) {
            return strtotime($b['start_date']) - strtotime($a['start_date']);
        });

        $data = [
            'work_experiences' => $filteredExperiences,
            'skill' => $skill,
            'title' => 'Pengalaman dengan Skill: ' . $skill
        ];

        return view('work-experiences/experience', $data);
    }

    /**
     * Get timeline data for visualization
     */
    public function timeline()
    {
        $experiences = $this->WorkExperienceModel->getWorkExperiences('start_date', 'ASC');

        $data = [
            'work_experiences' => $experiences,
            'title' => 'Timeline Karir'
        ];

        return view('work-experiences/work-experience-timeline', $data);
    }

    /**
     * Download CV/Resume based on work experiences
     */
    public function downloadCV()
    {
        $experiences = $this->WorkExperienceModel->getWorkExperiences('start_date', 'DESC');

        // Generate PDF atau Word document
        // Anda bisa menggunakan library seperti TCPDF atau Dompdf

        $data = [
            'work_experiences' => $experiences
        ];

        // Contoh sederhana menggunakan view untuk generate HTML yang akan di-print
        return view('public/cv-template', $data);
    }

    /**
     * Helper: Calculate period between two dates
     */
    private function calculatePeriod($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = $endDate ? new \DateTime($endDate) : new \DateTime();

        $interval = $start->diff($end);

        $years = $interval->y;
        $months = $interval->m;

        $period = '';

        if ($years > 0) {
            $period .= $years . ' tahun';
        }

        if ($months > 0) {
            if ($period) $period .= ' ';
            $period .= $months . ' bulan';
        }

        if (!$period) {
            $period = '< 1 bulan';
        }

        return $period;
    }

    /**
     * Get statistics data
     */
    public function statistics()
    {
        $experiences = $this->WorkExperienceModel->findAll();

        $stats = [
            'total_experiences' => count($experiences),
            'total_companies' => count(array_unique(array_column($experiences, 'company_name'))),
            'current_positions' => count(array_filter($experiences, function ($exp) {
                return $exp['is_current'] == 1;
            })),
            'total_years' => 0,
            'skills' => []
        ];

        // Calculate total years and collect all skills
        foreach ($experiences as $exp) {
            $start = new \DateTime($exp['start_date']);
            $end = $exp['end_date'] ? new \DateTime($exp['end_date']) : new \DateTime();
            $stats['total_years'] += $start->diff($end)->y;

            $skills = json_decode($exp['skills_used'], true) ?? [];
            $stats['skills'] = array_merge($stats['skills'], $skills);
        }

        // Count skill frequency
        $stats['skills'] = array_count_values($stats['skills']);
        arsort($stats['skills']);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $stats
        ]);
    }
}
