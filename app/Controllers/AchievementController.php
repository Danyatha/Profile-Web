<?php

namespace App\Controllers;

use App\Models\AchievementModel;

class AchievementController extends BaseAdminController
{
    protected AchievementModel $model;

    private const UPLOAD_PATH  = 'uploads/achievements';
    private const REDIRECT_URL = '/admin/achievement';

    public function __construct()
    {
        $this->model = new AchievementModel();
    }

    public function index()
    {
        return view('control/achievement-index', [
            'title'        => 'Daftar Achievements',
            'achievements' => $this->model->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        return view('control/achievement/create-achievement', [
            'title'      => 'Tambah Achievement',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->model->getValidationRules())) {
            return $this->redirectWithValidation();
        }

        $data = $this->collectFormData();

        $filename = $this->uploadSingleFile('images_path', self::UPLOAD_PATH);
        if ($filename) {
            $data['images_path'] = $filename;
        }

        $this->model->save($data);

        return $this->redirectSuccess(self::REDIRECT_URL, 'Achievement berhasil ditambahkan');
    }

    public function show($id)
    {
        return view('control/achievement/show-achievement', [
            'title'       => 'Detail Achievement',
            'achievement' => $this->findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return view('control/achievement/edit-achievement', [
            'title'       => 'Edit Achievement',
            'achievement' => $this->findOrFail($id),
            'validation'  => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $achievement = $this->findOrFail($id);

        if (! $this->validate($this->model->getValidationRules())) {
            return $this->redirectWithValidation();
        }

        $data = $this->collectFormData();

        $filename = $this->uploadSingleFile('images_path', self::UPLOAD_PATH);
        if ($filename) {
            // Remove old image when a new one is uploaded
            $this->deleteFile($achievement['images_path'] ?? null, self::UPLOAD_PATH);
            $data['images_path'] = $filename;
        }

        if ($this->model->update($id, $data)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Achievement berhasil diupdate');
        }

        return $this->redirectError('Gagal mengupdate achievement');
    }

    public function delete($id)
    {
        $achievement = $this->findOrFail($id);

        $this->deleteFile($achievement['images_path'] ?? null, self::UPLOAD_PATH);
        $this->model->delete($id);

        return $this->redirectSuccess(self::REDIRECT_URL, 'Achievement berhasil dihapus');
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /** Collect shared POST fields. */
    private function collectFormData(): array
    {
        return [
            'title'       => $this->request->getPost('title'),
            'event_name'  => $this->request->getPost('event_name'),
            'achievement' => $this->request->getPost('achievement'),
            'description' => $this->request->getPost('description'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
        ];
    }

    /** Find record or throw 404. */
    private function findOrFail(int|string $id): array
    {
        $row = $this->model->find($id);

        if (! $row) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Achievement tidak ditemukan'
            );
        }

        return $row;
    }
}
