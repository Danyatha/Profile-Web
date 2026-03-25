<?php

namespace App\Controllers;

use App\Models\SkillModel;

class SkillController extends BaseAdminController
{
    protected SkillModel $model;

    private const UPLOAD_PATH  = 'uploads/skills';
    private const REDIRECT_URL = '/admin/skills';

    public function __construct()
    {
        $this->model = new SkillModel();
    }

    public function index()
    {
        return view('control/skill-index', [
            'title'  => 'Daftar Skills',
            'skills' => $this->model->findAll(),
        ]);
    }

    public function create()
    {
        return view('control/skill/create-skill', [
            'title'      => 'Tambah Skill',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        $rules = array_merge($this->model->getValidationRules(), [
            'image_path' => 'permit_empty|is_image[image_path]'
                          . '|mime_in[image_path,image/jpg,image/jpeg,image/png,image/webp]'
                          . '|max_size[image_path,2048]',
        ]);

        if (! $this->validate($rules)) {
            return $this->redirectWithValidation();
        }

        $data     = $this->collectFormData();
        $filename = $this->uploadSingleFile('image_path', self::UPLOAD_PATH);
        if ($filename) {
            $data['image_path'] = $filename;
        }

        $this->model->save($data);

        return $this->redirectSuccess(self::REDIRECT_URL, 'Skill berhasil ditambahkan');
    }

    public function show($id)
    {
        return view('control/skill/show-skill', [
            'title' => 'Detail Skill',
            'skill' => $this->findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return view('control/skill/edit-skill', [
            'title'      => 'Edit Skill',
            'skill'      => $this->findOrFail($id),
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $skill = $this->findOrFail($id);

        if (! $this->validate($this->model->getValidationRules())) {
            return $this->redirectWithValidation();
        }

        $data     = $this->collectFormData();
        $filename = $this->uploadSingleFile('image_path', self::UPLOAD_PATH);

        if ($filename) {
            $this->deleteFile($skill['image_path'] ?? null, self::UPLOAD_PATH);
            $data['image_path'] = $filename;
        }

        if ($this->model->update($id, $data)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Skill berhasil diupdate');
        }

        return $this->redirectError('Gagal mengupdate skill');
    }

    public function delete($id)
    {
        $skill = $this->findOrFail($id);

        $this->deleteFile($skill['image_path'] ?? null, self::UPLOAD_PATH);

        if ($this->model->delete($id)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Skill berhasil dihapus');
        }

        return redirect()->to(self::REDIRECT_URL)->with('error', 'Gagal menghapus skill');
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function collectFormData(): array
    {
        return [
            'skill_name'  => $this->request->getPost('skill_name'),
            'category'    => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
        ];
    }

    private function findOrFail(int|string $id): array
    {
        $row = $this->model->find($id);

        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Skill dengan ID ' . $id . ' tidak ditemukan'
            );
        }

        return $row;
    }
}
