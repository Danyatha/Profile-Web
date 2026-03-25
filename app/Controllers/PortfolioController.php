<?php

namespace App\Controllers;

use App\Models\PortfolioModel;

class PortfolioController extends BaseAdminController
{
    protected PortfolioModel $model;

    private const UPLOAD_PATH  = 'uploads/portfolio';
    private const REDIRECT_URL = '/admin/portfolio';

    public function __construct()
    {
        $this->model = new PortfolioModel();
    }

    public function index()
    {
        return view('control/portfolio-index', [
            'title'      => 'Daftar Portfolio',
            'portfolios' => $this->model->getAllPortfolios(),
        ]);
    }

    public function show($id)
    {
        return view('control/portfolio/show', [
            'title'     => 'Detail Portfolio',
            'portfolio' => $this->findOrFail($id),
        ]);
    }

    public function create()
    {
        return view('control/portfolio/create', [
            'title'      => 'Tambah Portfolio',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->model->getValidationRules())) {
            return $this->redirectWithValidation();
        }

        $data = $this->collectFormData();

        $filename = $this->uploadSingleFile('images', self::UPLOAD_PATH);
        if ($filename) {
            $data['images_path'] = self::UPLOAD_PATH . '/' . $filename;
        }

        if ($this->model->insert($data)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Portfolio berhasil ditambahkan');
        }

        return $this->redirectError('Gagal menambahkan portfolio');
    }

    public function edit($id)
    {
        return view('control/portfolio/edit', [
            'title'      => 'Edit Portfolio',
            'portfolio'  => $this->findOrFail($id),
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $portfolio = $this->findOrFail($id);

        if (! $this->validate($this->model->getValidationRules())) {
            return $this->redirectWithValidation();
        }

        $data     = $this->collectFormData();
        $filename = $this->uploadSingleFile('images', self::UPLOAD_PATH);

        if ($filename) {
            // Remove old image before saving new one
            $this->deleteFile(basename($portfolio['images_path'] ?? ''), self::UPLOAD_PATH);
            $data['images_path'] = self::UPLOAD_PATH . '/' . $filename;
        }

        if ($this->model->update($id, $data)) {
            return $this->redirectSuccess(self::REDIRECT_URL, 'Portfolio berhasil diupdate');
        }

        return $this->redirectError('Gagal mengupdate portfolio');
    }

    public function delete($id)
    {
        $portfolio = $this->findOrFail($id);

        $this->deleteFile(basename($portfolio['images_path'] ?? ''), self::UPLOAD_PATH);
        $this->model->delete($id);

        return $this->redirectSuccess(self::REDIRECT_URL, 'Portfolio berhasil dihapus');
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        return view('control/portfolio-index', [
            'title'      => 'Hasil Pencarian Portfolio',
            'portfolios' => $this->model->searchPortfolios($keyword),
            'keyword'    => $keyword,
        ]);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function collectFormData(): array
    {
        return [
            'project_name'      => $this->request->getPost('project_name'),
            'description'       => $this->request->getPost('description'),
            'technologies_used' => $this->request->getPost('technologies_used'),
            'project_url'       => $this->request->getPost('project_url'),
        ];
    }

    private function findOrFail(int|string $id): array
    {
        $row = $this->model->find($id);

        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Portfolio tidak ditemukan');
        }

        return $row;
    }
}
