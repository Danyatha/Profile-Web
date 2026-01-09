<?php

namespace App\Controllers;

use App\Models\SocialMediaModel;
use CodeIgniter\Controller;

class SocialMediaController extends Controller
{
    protected $socialMediaModel;

    public function __construct()
    {
        $this->socialMediaModel = new SocialMediaModel();
    }

    public function index()
    {
        $socialMediaLinks = $this->socialMediaModel->findAll();

        $data = [
            'title' => 'Social Media Links',
            'subtitle' => 'Connect with me on social media platforms',
            'socialMediaLinks' => $socialMediaLinks,
        ];

        return view('control/social-media-index', $data);
    }
    public function create()
    {
        $data = [
            'platform_name' => $this->request->getPost('platform_name'),
            'profile_url' => $this->request->getPost('profile_url'),
        ];

        $iconClass = $this->request->getFile('icon_class');
        if ($iconClass && $iconClass->isValid() && !$iconClass->hasMoved()) {
            $newName = $iconClass->getRandomName();
            $iconClass->move(FCPATH . 'upload/icon_class/', $newName);
            $data['icon_class'] = $newName;
        }
        $this->socialMediaModel->save($data);
        return redirect()->to('/admin/social-media')->with('success', 'Social Media Berhasil Ditambahkan');
    }
    public function edit($id)
    {
        $socialMedia = $this->socialMediaModel->find($id);
        if (!$socialMedia) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }
        $data = [
            'title' => 'Edit Social Media',
            'social_media' => $socialMedia,
            'validation' => \config\Services::validation()
        ];
        return view('control/social-media/edit-social-media');
    }
    public function update($id)
    {
        $socialMedia = $this->socialMediaModel->find($id);
        if (!$socialMedia) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }
        $rules = [
            'platform_name' => 'required|max_length[100]',
            'profile_url' => 'required|valid_url|max_length[255]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'platform_name' => $this->request->getPost('platform_name'),
            'profile_url' => $this->request->getPost('profile_url'),
        ];
        $this->socialMediaModel->update($data, ['id' => $id]);
        return redirect()->to('/admin/social-media')->with('success', 'Social Media Berhasil Diubah');
    }
    public function delete($id)
    {
        $socialMedia = $this->socialMediaModel->find($id);
        if (!$socialMedia) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }
        $this->socialMediaModel->delete($id);
        return redirect()->to('/admin/social-media')->with('success', 'Social Media Berhasil Dihapus');
    }
}
