<?php

namespace App\Controllers;

use App\Models\SkillModel;
use CodeIgniter\Controller;

class SkillController extends Controller
{
    protected $skillModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->skillModel = new SkillModel();
    }

    public function index()
    {
        $this->skillModel = new SkillModel();
        $data = [
            'title' => 'Daftar Skills',
            'skills' => $this->skillModel->findAll()
        ];
        return view('control/skill-index', $data);
    }

    // Menampilkan form tambah skill
    public function create()
    {
        $data = [
            'title' => 'Tambah Skill',
            'validation' => \Config\Services::validation()
        ];

        return view('control/skill/create-skill', $data);
    }

    // Menyimpan data skill baru
    public function store()
    {
        $rules = [
            'skill_name' => 'required|max_length[100]',
            'category'   => 'required|max_length[100]',
            'description' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'skill_name'  => $this->request->getPost('skill_name'),
            'category'    => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->skillModel->save($data)) {
            return redirect()->to('/admin/skills')->with('success', 'Skill berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan skill');
        }
    }

    // Menampilkan form edit skill
    public function edit($id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Skill dengan ID ' . $id . ' tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Skill',
            'skill' => $skill,
            'validation' => \Config\Services::validation()
        ];

        return view('control/skill/edit-skill', $data);
    }

    // Mengupdate data skill
    public function update($id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Skill dengan ID ' . $id . ' tidak ditemukan');
        }

        $rules = [
            'skill_name' => 'required|max_length[100]',
            'category'   => 'required|max_length[100]',
            'description' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'skill_name'  => $this->request->getPost('skill_name'),
            'category'    => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->skillModel->update($id, $data)) {
            return redirect()->to('/admin/skills')->with('success', 'Skill berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate skill');
        }
    }

    // Menghapus skill
    public function delete($id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            return redirect()->to('/admin/skills')->with('error', 'Skill tidak ditemukan');
        }

        if ($this->skillModel->delete($id)) {
            return redirect()->to('/admin/skills')->with('success', 'Skill berhasil dihapus');
        } else {
            return redirect()->to('/admin/skills')->with('error', 'Gagal menghapus skill');
        }
    }
    // Menampilkan detail skill
    public function show($id)
    {
        $skill = $this->skillModel->find($id);

        if (!$skill) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Skill dengan ID ' . $id . ' tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Skill',
            'skill' => $skill
        ];

        return view('control/skill/show-skill', $data);
    }
}
