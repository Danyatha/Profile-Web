<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class ProfileController extends BaseAdminController
{
    protected ProfileModel $model;

    public function __construct()
    {
        $this->model = new ProfileModel();
    }

    public function index()
    {
        return view('profiles/index', [
            'title'    => 'Profiles',
            'profiles' => $this->model->findAll(),
        ]);
    }

    public function show($id)
    {
        $profile = $this->model->find($id);

        if (! $profile) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Profile tidak ditemukan');
        }

        return view('profiles/show', ['profile' => $profile]);
    }
}
