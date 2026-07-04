<?php

namespace App\Controllers;

use App\Models\AchievementModel;
use App\Models\CertificationModel;
use App\Models\PortfolioModel;
use App\Models\SkillModel;
use App\Models\WorkExperienceModel;

/**
 * DashboardController
 *
 * Loads real counts from models instead of hard-coded values.
 * Each management page simply passes the title; the view fetches its
 * own data via AJAX or a dedicated controller.
 */
class DashboardController extends BaseAdminController
{
    protected $achievementModel;
    protected $certificationModel;
    protected $portfolioModel;
    protected $skillModel;
    protected $workExperienceModel; 
    

    public function __construct()
    {
        $this->achievementModel = new AchievementModel();
        $this->certificationModel = new CertificationModel();
        $this->portfolioModel = new PortfolioModel();
        $this->skillModel = new SkillModel();
        $this->workExperienceModel = new WorkExperienceModel();
    }
    public function dashboard()
    {
        $data = [
            'title'               => 'Dashboard Admin',
            'total_portfolio'     => $this->portfolioModel->countAllResults(),
            'total_skills'        => $this->skillModel->countAllResults(),
            'total_certificates'  => $this->certificationModel->countAllResults(),
            'total_experiences'   => $this->workExperienceModel->countAllResults(),
        ];

        return view('control/dashboard', $data);
    }

    public function portfolio()
    {
        $data = [
            'title' => 'Manage Portfolio',
            'total_portfolio' => $this->portfolioModel->countAllResults(),
        ];

        return view('control/portfolio', $data);
    }

    public function skills()
    {
        $data = [
            'title' => 'Manage Skills',
            'total_skills' => $this->skillModel->countAllResults(),
        ];

        return view('admin/skills', $data);
    }

    public function experiences()
    {
        $data = [
            'title' => 'Manage Work Experiences',
            'total_experiences' => $this->workExperienceModel->countAllResults(),
        ];

        return view('control/work-experience-index', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Manage Profile',
        ];

        return view('admin/profile', $data);
    }
}
