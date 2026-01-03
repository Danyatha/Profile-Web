<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller
{
    // Dashboard
    public function dashboard()
    {

        $data = [
            'title' => 'Dashboard Admin',
            'total_portfolio' => 12,
            'total_skills' => 8,
            'total_certificates' => 15,
            'total_experiences' => 5
        ];

        return view('control/dashboard', $data);
    }

    // Portfolio Management
    public function portfolio()
    {

        $data = [
            'title' => 'Manage Portfolio'
        ];

        return view('control/portfolio', $data);
    }

    // Skills Management
    public function skills()
    {

        $data = [
            'title' => 'Manage Skills'
        ];

        return view('admin/skills', $data);
    }

    // Certificates Management
    // public function certificates()
    // {

    //     $data = [
    //         'title' => 'Manage Certificates'
    //     ];

    //     return view('admin/certificates', $data);
    // }

    // Work Experience Management
    public function experiences()
    {

        $data = [
            'title' => 'Manage Work Experiences'
        ];

        return view('control/work-experience-index', $data);
    }

    // Profile Management
    public function profile()
    {

        $data = [
            'title' => 'Manage Profile'
        ];

        return view('admin/profile', $data);
    }
}
