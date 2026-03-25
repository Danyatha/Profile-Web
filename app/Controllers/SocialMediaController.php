<?php

namespace App\Controllers;

use App\Models\SocialMediaModel;

class SocialMediaController extends BaseAdminController
{
    protected SocialMediaModel $model;

    private const UPLOAD_PATH  = 'uploads/icons';
    private const REDIRECT_URL = '/admin/social-media';

    public function __construct()
    {
        $this->model = new SocialMediaModel();
    }

    public function index()
    {
        return view('control/social-media-index', [
            'title'           => 'Social Media Links',
            'subtitle'        => 'Connect with me on social media platforms',
            'socialMediaLinks' => $this->model->findAll(),
        ]);
    }

    public function create()
    {
        return view('control/social-media/create-social-media', [
            'title'      => 'Tambah Social Media',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->getValidationRules())) {
            return $this->redirectWithValidation();
        }

        $data = $this->collectFormData();

        $filename = $this->uploadSingleFile('icon_class', self::UPLOAD_PATH);
        if ($filename) {
            $data['icon_class'] = $filename;
        }

        $this->model->save($data);

        return $this->redirectSuccess(self::REDIRECT_URL, 'Social Media berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('control/social-media/edit-social-media', [
            'title'        => 'Edit Social Media',
            'social_media' => $this->findOrFail($id),
            'validation'   => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $socialMedia = $this->findOrFail($id);

        if (! $this->validate($this->getValidationRules())) {
            return $this->redirectWithValidation();
        }

        $data = $this->collectFormData();

        $filename = $this->uploadSingleFile('icon_class', self::UPLOAD_PATH);
        if ($filename) {
            $this->deleteFile($socialMedia['icon_class'] ?? null, self::UPLOAD_PATH);
            $data['icon_class'] = $filename;
        }

        // Fixed: update($id, $data) — original had arguments reversed
        $this->model->update($id, $data);

        return $this->redirectSuccess(self::REDIRECT_URL, 'Social Media berhasil diubah');
    }

    public function delete($id)
    {
        $socialMedia = $this->findOrFail($id);

        $this->deleteFile($socialMedia['icon_class'] ?? null, self::UPLOAD_PATH);
        $this->model->delete($id);

        return $this->redirectSuccess(self::REDIRECT_URL, 'Social Media berhasil dihapus');
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function getValidationRules(): array
    {
        return [
            'platform_name' => 'required|max_length[100]',
            'profile_url'   => 'required|valid_url|max_length[255]',
        ];
    }

    private function collectFormData(): array
    {
        return [
            'platform_name' => $this->request->getPost('platform_name'),
            'profile_url'   => $this->request->getPost('profile_url'),
        ];
    }

    private function findOrFail(int|string $id): array
    {
        $row = $this->model->find($id);

        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return $row;
    }
}
