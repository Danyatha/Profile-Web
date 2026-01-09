<?php

namespace App\Controllers;

use App\Models\AchievementModel;
use App\Models\CertificationModel;
use CodeIgniter\Controller;

class AchievementPublicController extends Controller
{
    protected $achievementModel;
    protected $certificationModel;

    public function __construct()
    {
        $this->achievementModel = new AchievementModel();
        $this->certificationModel = new CertificationModel();
    }

    public function index()
    {
        $achievements = $this->achievementModel->findAll();
        $certifications = $this->certificationModel->findAll();

        $data = [
            'title' => 'Achievements & Certifications',
            'subtitle' => 'achievements and certifications I have earned ',
            'title1' => 'Achievements',
            'subtitle1' => 'List of achievements and accomplishments',
            'title2' => 'Certifications',
            'subtitle2' => 'List of certifications I have obtained',
            'achievements' => $achievements,
            'certifications' => $certifications,
        ];

        return view('achievement/achievement', $data);
    }
    public function detail($id)
    {
        $achievement = $this->achievementModel->find($id);
        $certification = $this->certificationModel->find($id);

        if (!$achievement && !$certification) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Achievement not found');
        }

        $data = [
            'title' => 'Achievement Details',
            'achievement' => $achievement,
            'certification' => $certification,
        ];

        return view('achievement/show', $data);
    }
}
