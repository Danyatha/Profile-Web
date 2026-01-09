<?php

namespace App\Controllers;

use App\Models\AchievementModel;
use CodeIgniter\Controller;

class AchievementController extends Controller
{
    protected $achievementModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->achievementModel = new AchievementModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Achievements',
            'achievements' => $this->achievementModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('control/achievement-index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Achievement',
            'validation' => \Config\Services::validation()
        ];

        return view('control/achievement/create-achievement', $data);
    }

    public function store()
    {
        if (!$this->validate($this->achievementModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'event_name'  => $this->request->getPost('event_name'),
            'achievement' => $this->request->getPost('achievement'),
            'description' => $this->request->getPost('description'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
        ];

        $image = $this->request->getFile('images_path');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/achievements/', $newName);
            $data['images_path'] = $newName;
        }
        $this->achievementModel->save($data);
        return redirect()->to('/admin/achievement')->with('success', 'Achievement berhasil ditambahkan');
    }

    public function edit($id)
    {
        $achievement = $this->achievementModel->find($id);

        if (!$achievement) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Achievement',
            'achievement' => $achievement,
            'validation' => \Config\Services::validation()
        ];

        return view('control/achievement/edit-achievement', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->achievementModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'event_name'  => $this->request->getPost('event_name'),
            'achievement' => $this->request->getPost('achievement'),
            'description' => $this->request->getPost('description'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
        ];
        $image = $this->request->getFile('images_path');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/achievements/', $newName);
            $data['images_path'] = $newName;
        }

        if ($this->achievementModel->update($id, $data)) {
            return redirect()->to('admin/achievement')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Data gagal diupdate');
        }
    }

    public function delete($id)
    {
        if ($this->achievementModel->delete($id)) {
            return redirect()->to('admin/achievement')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }

    public function show($id)
    {
        $achievement = $this->achievementModel->find($id);

        if (!$achievement) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Detail Achievement',
            'achievement' => $achievement
        ];

        return view('control/achievement/show-achievement', $data);
    }
}
