<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class ProfileController extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $data = [
            'profiles' => $this->profileModel->findAll(),
            'title' => 'Profiles',
        ];
        return view('profiles/index', $data);
    }

    public function show($id)
    {
        $data['profile'] = $this->profileModel->find($id);
        return view('profiles/show', $data);
    }
}
