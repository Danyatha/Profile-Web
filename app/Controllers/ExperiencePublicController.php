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
     * Halaman publik untuk menampilkan semua work experience dengan filter tahun
     */
    public function index()
    {
        $year = $this->request->getGet('year');

        // Get all available years from database
        $availableYears = $this->WorkExperienceModel->getAvailableYears();

        // Get experiences based on year filter
        if ($year) {
            $experiences = $this->WorkExperienceModel->getWorkExperiencesByYear($year);
        } else {
            $experiences = $this->WorkExperienceModel->getWorkExperiences('start_date', 'DESC');
        }

        $data = [
            'work_experiences' => $experiences,
            'available_years' => $availableYears,
            'selected_year' => $year,
            'title' => 'Work Experiences',
            'subtitle' => 'see my work experiences and professional journey over the years'
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
            throw new \CodeIgniter\Exceptions\PageNotFoundException('work experience not found');
        }

        $data = [
            'work_experience' => $workExperience,
            'title' => $workExperience['position'] . ' - ' . $workExperience['company_name'],
            'subtitle' => 'Detail my experience as ' . $workExperience['position'] . ' di ' . $workExperience['company_name']
        ];

        return view('work-experiences/detail-work-experience', $data);
    }

    /**
     * Get work experiences as JSON (untuk AJAX atau API)
     */
    public function api()
    {
        $year = $this->request->getGet('year');

        if ($year) {
            $experiences = $this->WorkExperienceModel->getWorkExperiencesByYear($year);
        } else {
            $experiences = $this->WorkExperienceModel->getWorkExperiences('start_date', 'DESC');
        }

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
            'title' => 'Experience at ' . $companyName
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
            'title' => 'Current Work',
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

        foreach ($experiences as $exp) {
            $start = new \DateTime($exp['start_date']);
            $end = $exp['end_date'] ? new \DateTime($exp['end_date']) : new \DateTime();
            $stats['total_years'] += $start->diff($end)->y;

            $skills = json_decode($exp['skills_used'], true) ?? [];
            $stats['skills'] = array_merge($stats['skills'], $skills);
        }

        $stats['skills'] = array_count_values($stats['skills']);
        arsort($stats['skills']);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $stats
        ]);
    }
}
