<?php

namespace App\Controllers;

use App\Models\JournalModel;

class Home extends BaseController
{
    public function index()
    {
        $journalModel = new JournalModel();

        $data = [
            'title' => 'Home',
            'journals' => $journalModel->getPublished(6), // Ambil 6 jurnal terbaru
        ];
        return view('dashboard/index', $data);
    }
}
