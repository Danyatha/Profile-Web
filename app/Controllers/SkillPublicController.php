<?php

namespace App\Controllers;

use App\Models\SkillModel;
use CodeIgniter\Controller;

class SkillPublicController extends Controller
{
    protected $skillModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->skillModel = new SkillModel();
    }

    // Menampilkan semua skills
    public function index()
    {
        $data = [
            'title' => 'Skills',
            'subtitle' => 'Tools, technologies, and skills I work with',
            'skills' => $this->skillModel->findAll()
        ];

        return view('skills/skill', $data);
    }
    public function detail($id)
    {
        $skill = $this->skillModel->getSkillById($id);

        if (!$skill) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Skill tidak ditemukan');
        }

        $data = [
            'title' => $skill['skill_name'],
            'skill' => $skill
        ];

        return view('skills/detail-skill', $data);
    }
}
