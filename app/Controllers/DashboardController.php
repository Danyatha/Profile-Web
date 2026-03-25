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
    public function dashboard()
    {
        return view('control/dashboard', [
            'title'               => 'Dashboard Admin',
            'total_portfolio'     => (new PortfolioModel())->countAllResults(),
            'total_skills'        => (new SkillModel())->countAllResults(),
            'total_certificates'  => (new CertificationModel())->countAllResults(),
            'total_experiences'   => (new WorkExperienceModel())->countAllResults(),
        ]);
    }

    public function portfolio()
    {
        return view('control/portfolio', ['title' => 'Manage Portfolio']);
    }

    public function skills()
    {
        return view('admin/skills', ['title' => 'Manage Skills']);
    }

    public function experiences()
    {
        return view('control/work-experience-index', ['title' => 'Manage Work Experiences']);
    }

    public function profile()
    {
        return view('admin/profile', ['title' => 'Manage Profile']);
    }
}
