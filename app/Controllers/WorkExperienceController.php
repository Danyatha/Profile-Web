<?php

namespace App\Controllers;

use App\Models\WorkExperienceModel;

class WorkExperienceController extends BaseAdminController
{
    protected WorkExperienceModel $model;

    private const LOGO_PATH   = 'uploads/company_logos';
    private const DOCS_PATH   = 'uploads/documentation';
    private const REDIRECT_URL = '/admin/experiences';

    public function __construct()
    {
        $this->model = new WorkExperienceModel();
    }

    public function index()
    {
        return view('control/work-experience-index', [
            'title'            => 'Work Experiences',
            'work_experiences' => $this->model->getWorkExperiences(),
        ]);
    }

    public function create()
    {
        return view('control/work-experience/create-experience', [
            'title'      => 'Tambah Pengalaman Kerja',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->getValidationRules())) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data               = $this->collectFormData();
        $data['company_logo']         = $this->handleLogoUpload();
        $data['documentation_images'] = $this->uploadMultipleFiles('documentation_images', self::DOCS_PATH);

        if ($this->model->insert($data)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Pengalaman kerja berhasil ditambahkan!');
        }

        return $this->redirectError('Gagal menambahkan pengalaman kerja!');
    }

    public function show($id)
    {
        return view('control/work-experience/detail-work-experience', [
            'title'           => 'Detail Work Experience',
            'work_experience' => $this->findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return view('control/work-experience/edit-experience', [
            'title'           => 'Edit Pengalaman Kerja',
            'experience' => $this->findOrFail($id),
            'validation'      => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $workExperience = $this->findOrFail($id);

        if (! $this->validate($this->getValidationRules())) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = $this->collectFormData();

        // Logo: upload new → delete old
        $newLogo = $this->handleLogoUpload();
        if ($newLogo) {
            $this->deleteFile($workExperience['company_logo'] ?? null, self::LOGO_PATH);
            $data['company_logo'] = $newLogo;
        }

        // Docs: merge new uploads with existing list
        $existingDocs = $workExperience['documentation_images'] ?? [];
        $newDocs         = $this->uploadMultipleFiles('documentation_images', self::DOCS_PATH);
        $data['documentation_images'] = array_merge($existingDocs, $newDocs);

        if ($this->model->update($id, $data)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Pengalaman kerja berhasil diperbarui!');
        }

        return $this->redirectError('Gagal memperbarui pengalaman kerja!');
    }

    public function delete($id)
    {
        $workExperience = $this->findOrFail($id);

        // Clean up files
        $this->deleteFile($workExperience['company_logo'] ?? null, self::LOGO_PATH);

        $docs = json_decode($workExperience['documentation_images'] ?? '[]', true) ?? [];
        foreach ($docs as $filename) {
            $this->deleteFile($filename, self::DOCS_PATH);
        }

        if ($this->model->delete($id)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Pengalaman kerja berhasil dihapus!');
        }

        return redirect()->to(self::REDIRECT_URL)->with('error', 'Gagal menghapus pengalaman kerja!');
    }

    /**
     * AJAX: delete a single documentation image.
     */
    public function deleteImage()
    {
        $id        = $this->request->getPost('id');
        $imageName = $this->request->getPost('image_name');
        $workExp   = $this->model->find($id);

        if (! $workExp) {
            return $this->jsonError('Pengalaman kerja tidak ditemukan', 404);
        }

        $docs = json_decode($workExp['documentation_images'] ?? '[]', true) ?? [];

        if (! in_array($imageName, $docs, true)) {
            return $this->jsonError('Gambar tidak ditemukan');
        }

        $docs = array_values(array_diff($docs, [$imageName]));
        $this->model->update($id, ['documentation_images' => $docs]);
        $this->deleteFile($imageName, self::DOCS_PATH);

        return $this->jsonSuccess('Gambar berhasil dihapus');
    }

    // API: return work experiences as JSON
    public function getWorkExperienceJson()
    {
        return $this->response->setJSON($this->model->getWorkExperiences());
    }

    // Front-end view
    public function experience()
    {
        return view('work-experiences/experience');
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function getValidationRules(): array
    {
        return [
            'company_name'             => 'required|max_length[255]',
            'position'                 => 'required|max_length[255]',
            'start_date'               => 'required|valid_date',
            'end_date'                 => 'permit_empty|valid_date',
            'description'              => 'permit_empty|max_length[1000]',
            'job_description'          => 'permit_empty',
            'achievements'             => 'permit_empty',
            'company_logo'             => 'permit_empty|max_size[company_logo,2048]|is_image[company_logo]',
            'documentation_images.*'   => 'permit_empty|max_size[documentation_images.*,2048]|is_image[documentation_images.*]',
        ];
    }

    private function collectFormData(): array
    {
        return [
            'company_name'    => $this->request->getPost('company_name'),
            'position'        => $this->request->getPost('position'),
            'description'     => $this->request->getPost('description'),
            'job_description' => $this->request->getPost('job_description'),
            'start_date'      => $this->request->getPost('start_date'),
            'end_date'        => $this->request->getPost('end_date'),
            'is_current'      => $this->request->getPost('is_current') === '1',
            'achievements'    => $this->request->getPost('achievements'),
            'skills_used'     => $this->request->getPost('skills_used')
                ? explode(',', $this->request->getPost('skills_used'))
                : [],
        ];
    }

    private function handleLogoUpload(): ?string
    {
        return $this->uploadSingleFile('company_logo', self::LOGO_PATH);
    }

    private function findOrFail(int|string $id): array
    {
        $row = $this->model->getWorkExperienceById($id);

        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengalaman kerja tidak ditemukan');
        }

        return $row;
    }
}
