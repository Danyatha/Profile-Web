<?php

namespace App\Controllers;

use App\Models\WorkExperienceModel;
use CodeIgniter\Controller;

class WorkExperienceController extends BaseController
{
    protected $WorkExperienceModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->WorkExperienceModel = new WorkExperienceModel();
    }

    public function index()
    {
        $data = [
            'work_experiences' => $this->WorkExperienceModel->getWorkExperiences(),
            'title' => 'Work Experiences'
        ];
        return view('control/work-experience-index', $data);
    }

    public function create()
    {

        $data['title'] = 'Tambah Pengalaman Kerja';
        $data['validation'] = \Config\Services::validation();

        return view('control/work-experience/create-experience', $data);
    }

    public function store()
    {
        $rules = [
            'company_name' => 'required|max_length[255]',
            'position' => 'required|max_length[255]',
            'start_date' => 'required|valid_date',
            'end_date' => 'permit_empty|valid_date',
            'description' => 'permit_empty|max_length[1000]',
            'job_description' => 'permit_empty',
            'achievements' => 'permit_empty',
            'company_logo' => 'permit_empty|uploaded[company_logo]|max_size[company_logo,2048]|is_image[company_logo]',
            'documentation_images.*' => 'permit_empty|uploaded[documentation_images.*]|max_size[documentation_images.*,2048]|is_image[documentation_images.*]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'company_name' => $this->request->getPost('company_name'),
            'position' => $this->request->getPost('position'),
            'description' => $this->request->getPost('description'),
            'job_description' => $this->request->getPost('job_description'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'is_current' => $this->request->getPost('is_current') ? 1 : 0,
            'achievements' => $this->request->getPost('achievements'),
            'skills_used' => $this->request->getPost('skills_used') ? explode(',', $this->request->getPost('skills_used')) : []
        ];

        // Handle company logo upload
        $companyLogo = $this->request->getFile('company_logo');
        if ($companyLogo && $companyLogo->isValid()) {
            $logoName = $this->WorkExperienceModel->uploadFile($companyLogo, 'uploads/company_logos/');
            if ($logoName) {
                $data['company_logo'] = $logoName;
            }
        }

        // Handle documentation images upload
        $documentationImages = $this->request->getFiles();
        $uploadedImages = [];

        if (isset($documentationImages['documentation_images'])) {
            foreach ($documentationImages['documentation_images'] as $file) {
                if ($file->isValid()) {
                    $imageName = $this->WorkExperienceModel->uploadFile($file, 'uploads/documentation/');
                    if ($imageName) {
                        $uploadedImages[] = $imageName;
                    }
                }
            }
        }

        $data['documentation_images'] = $uploadedImages;

        if ($this->WorkExperienceModel->insert($data)) {
            return redirect()->to('/admin/experiences')->with('success', 'Pengalaman kerja berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pengalaman kerja!');
        }
    }

    public function show($id)
    {
        $workExperience = $this->WorkExperienceModel->getWorkExperienceById($id);

        if (!$workExperience) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengalaman kerja tidak ditemukan');
        }

        $data = [
            'work_experience' => $workExperience,
            'title' => 'Detail Work Experience',
        ];

        return view('control/work-experience/detail-work-experience', $data);
    }

    public function edit($id)
    {
        $workExperience = $this->WorkExperienceModel->getWorkExperienceById($id);

        if (!$workExperience) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengalaman kerja tidak ditemukan');
        }

        $data['work_experience'] = $workExperience;
        $data['title'] = 'Edit Pengalaman Kerja';
        $data['validation'] = \Config\Services::validation();

        return view('work_experience/edit', $data);
    }

    public function update($id)
    {
        $workExperience = $this->WorkExperienceModel->find($id);

        if (!$workExperience) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengalaman kerja tidak ditemukan');
        }

        $rules = [
            'company_name' => 'required|max_length[255]',
            'position' => 'required|max_length[255]',
            'start_date' => 'required|valid_date',
            'end_date' => 'permit_empty|valid_date',
            'description' => 'permit_empty|max_length[1000]',
            'job_description' => 'permit_empty',
            'achievements' => 'permit_empty',
            'company_logo' => 'permit_empty|uploaded[company_logo]|max_size[company_logo,2048]|is_image[company_logo]',
            'documentation_images.*' => 'permit_empty|uploaded[documentation_images.*]|max_size[documentation_images.*,2048]|is_image[documentation_images.*]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'company_name' => $this->request->getPost('company_name'),
            'position' => $this->request->getPost('position'),
            'description' => $this->request->getPost('description'),
            'job_description' => $this->request->getPost('job_description'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'is_current' => $this->request->getPost('is_current') ? 1 : 0,
            'achievements' => $this->request->getPost('achievements'),
            'skills_used' => $this->request->getPost('skills_used') ? explode(',', $this->request->getPost('skills_used')) : []
        ];

        // Handle company logo upload
        $companyLogo = $this->request->getFile('company_logo');
        if ($companyLogo && $companyLogo->isValid()) {
            // Delete old logo if exists
            if ($workExperience['company_logo']) {
                $this->WorkExperienceModel->deleteFile($workExperience['company_logo'], 'uploads/company_logos/');
            }

            $logoName = $this->WorkExperienceModel->uploadFile($companyLogo, 'uploads/company_logos/');
            if ($logoName) {
                $data['company_logo'] = $logoName;
            }
        }

        // Handle documentation images upload
        $documentationImages = $this->request->getFiles();
        $uploadedImages = json_decode($workExperience['documentation_images'], true) ?? [];

        if (isset($documentationImages['documentation_images'])) {
            foreach ($documentationImages['documentation_images'] as $file) {
                if ($file->isValid()) {
                    $imageName = $this->WorkExperienceModel->uploadFile($file, 'uploads/documentation/');
                    if ($imageName) {
                        $uploadedImages[] = $imageName;
                    }
                }
            }
        }

        $data['documentation_images'] = $uploadedImages;

        if ($this->WorkExperienceModel->update($id, $data)) {
            return redirect()->to('/admin/experiences')->with('success', 'Pengalaman kerja berhasil diperbarui!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui pengalaman kerja!');
        }
    }

    public function delete($id)
    {
        $workExperience = $this->WorkExperienceModel->find($id);

        if (!$workExperience) {
            return redirect()->to('/admin/experiences')->with('error', 'Pengalaman kerja tidak ditemukan!');
        }

        // Delete associated files
        if ($workExperience['company_logo']) {
            $this->WorkExperienceModel->deleteFile($workExperience['company_logo'], 'uploads/company_logos/');
        }

        $documentationImages = json_decode($workExperience['documentation_images'], true) ?? [];
        foreach ($documentationImages as $image) {
            $this->WorkExperienceModel->deleteFile($image, 'uploads/documentation/');
        }

        if ($this->WorkExperienceModel->delete($id)) {
            return redirect()->to('/admin/experiences')->with('success', 'Pengalaman kerja berhasil dihapus!');
        } else {
            return redirect()->to('/admin/experiences')->with('error', 'Gagal menghapus pengalaman kerja!');
        }
    }

    public function deleteImage()
    {
        $id = $this->request->getPost('id');
        $imageName = $this->request->getPost('image_name');

        $workExperience = $this->WorkExperienceModel->find($id);

        if (!$workExperience) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengalaman kerja tidak ditemukan']);
        }

        $documentationImages = json_decode($workExperience['documentation_images'], true) ?? [];

        if (in_array($imageName, $documentationImages)) {
            // Remove from array
            $documentationImages = array_values(array_diff($documentationImages, [$imageName]));

            // Update database
            $this->WorkExperienceModel->update($id, ['documentation_images' => $documentationImages]);

            // Delete file
            $this->WorkExperienceModel->deleteFile($imageName, 'uploads/documentation/');

            return $this->response->setJSON(['success' => true, 'message' => 'Gambar berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gambar tidak ditemukan']);
    }

    // API endpoints for AJAX
    public function getWorkExperienceJson()
    {
        $experiences = $this->WorkExperienceModel->getWorkExperiences();
        return $this->response->setJSON($experiences);
    }

    public function experience()
    {
        return view('work-experiences/experience');
    }
}
