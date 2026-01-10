<?php

namespace App\Controllers;

use App\Models\PortfolioModel;
use CodeIgniter\Controller;

class PortfolioController extends Controller
{
    protected $portfolioModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->portfolioModel = new PortfolioModel();
    }

    // Menampilkan semua portfolio
    public function index()
    {
        $data = [
            'title' => 'Daftar Portfolio',
            'portfolios' => $this->portfolioModel->getAllPortfolios()
        ];

        return view('control/portfolio-index', $data);
    }

    // Menampilkan detail portfolio
    public function show($id)
    {
        $portfolio = $this->portfolioModel->getPortfolioById($id);

        if (!$portfolio) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Portfolio tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Portfolio',
            'portfolio' => $portfolio
        ];

        return view('control/portfolio/show', $data);
    }

    // Menampilkan form tambah portfolio
    public function create()
    {
        $data = [
            'title' => 'Tambah Portfolio',
            'validation' => \Config\Services::validation()
        ];

        return view('control/portfolio/create', $data);
    }

    // Menyimpan data portfolio baru
    public function store()
    {
        if (!$this->validate($this->portfolioModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = $this->uploadImage();

        $data = [
            'project_name' => $this->request->getPost('project_name'),
            'description' => $this->request->getPost('description'),
            'technologies_used' => $this->request->getPost('technologies_used'),
            'project_url' => $this->request->getPost('project_url'),
            'images_path' => $imagePath
        ];

        if ($this->portfolioModel->insert($data)) {
            return redirect()->to('/admin/portfolio')->with('success', 'Portfolio berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan portfolio');
        }
    }

    // Menampilkan form edit portfolio
    public function edit($id)
    {
        $portfolio = $this->portfolioModel->getPortfolioById($id);

        if (!$portfolio) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Portfolio tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Portfolio',
            'portfolio' => $portfolio,
            'validation' => \Config\Services::validation()
        ];

        return view('control/portfolio/edit', $data);
    }

    // Update data portfolio
    public function update($id)
    {
        if (!$this->validate($this->portfolioModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $portfolio = $this->portfolioModel->getPortfolioById($id);

        if (!$portfolio) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Portfolio tidak ditemukan');
        }

        $imagePath = $this->uploadImage();

        // Jika ada upload gambar baru, hapus gambar lama
        if ($imagePath && $portfolio['images_path']) {
            $this->deleteOldImage($portfolio['images_path']);
        }

        $data = [
            'project_name' => $this->request->getPost('project_name'),
            'description' => $this->request->getPost('description'),
            'technologies_used' => $this->request->getPost('technologies_used'),
            'project_url' => $this->request->getPost('project_url'),
        ];

        if ($imagePath) {
            $data['images_path'] = $imagePath;
        }

        if ($this->portfolioModel->update($id, $data)) {
            return redirect()->to('/admin/portfolio')->with('success', 'Portfolio berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate portfolio');
        }
    }

    // Hapus portfolio
    public function delete($id)
    {
        $portfolio = $this->portfolioModel->getPortfolioById($id);

        if (!$portfolio) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Portfolio tidak ditemukan');
        }

        // Hapus gambar jika ada
        if ($portfolio['images_path']) {
            $this->deleteOldImage($portfolio['images_path']);
        }

        if ($this->portfolioModel->delete($id)) {
            return redirect()->to('/admin/portfolio')->with('success', 'Portfolio berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus portfolio');
        }
    }

    // Upload image helper
    private function uploadImage()
    {
        $file = $this->request->getFile('images');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . '../public/uploads/portfolio', $newName);
            return 'uploads/portfolio/' . $newName;
        }

        return null;
    }

    // Delete old image helper
    private function deleteOldImage($imagePath)
    {
        $fullPath = FCPATH . $imagePath;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    // Search portfolio
    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        $data = [
            'title' => 'Hasil Pencarian Portfolio',
            'portfolios' => $this->portfolioModel->searchPortfolios($keyword),
            'keyword' => $keyword
        ];

        return view('control/portfolio-index', $data);
    }
}
