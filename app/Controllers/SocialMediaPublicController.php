<?php

namespace App\Controllers;

use App\Models\SocialMediaModel;
use CodeIgniter\Controller;

class SocialMediaPublicController extends Controller
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

        return view('social-media/social-media', $data);
    }
    public function detail($id)
    {
        $socialMedia = $this->socialMediaModel->find($id);

        if (!$socialMedia) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Social Media tidak ditemukan');
        }

        $data = [
            'title' => $socialMedia['platform_name'],
            'socialMedia' => $socialMedia
        ];

        return view('social-media/detail-social-media', $data);
    }
}
