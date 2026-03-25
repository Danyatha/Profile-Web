<?php

namespace App\Controllers;

use App\Models\JournalModel;

/**
 * JournalController
 * Mengelola tampilan jurnal untuk publik (index + detail).
 */
class JournalPublicController extends BaseController
{
    protected JournalModel $model;

    public function __construct()
    {
        $this->model = new JournalModel();
    }

    // ----------------------------------------------------------------
    // Public: Daftar semua jurnal
    // ----------------------------------------------------------------
    public function index(): string
    {
        $perPage  = 9;
        $page     = (int) ($this->request->getGet('page') ?? 1);
        $offset   = ($page - 1) * $perPage;
        $category = $this->request->getGet('category');

        if ($category) {
            $journals = $this->model->getByCategory($category, $perPage);
            $total    = count($journals); // simplified untuk filter kategori
        } else {
            $journals = $this->model->getPublished($perPage, $offset);
            $total    = $this->model->countPublished();
        }

        // Pagination sederhana
        $totalPages = (int) ceil($total / $perPage);

        $data = [
            'title'      => 'Journal & Notes',
            'journals'   => $journals,
            'categories' => $this->model->getCategories(),
            'page'       => $page,
            'totalPages' => $totalPages,
            'category'   => $category,
        ];

        return view('journal/journal', $data);
    }

    // ----------------------------------------------------------------
    // Public: Detail jurnal berdasarkan slug
    // ----------------------------------------------------------------
    public function show(string $slug): string
    {
        $journal = $this->model->getBySlug($slug);

        if (!$journal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Jurnal tidak ditemukan.'
            );
        }

        // Ambil 3 jurnal terkait (kategori sama, exclude current)
        $related = [];
        if (!empty($journal['category'])) {
            $related = $this->model
                ->where('category', $journal['category'])
                ->where('id !=', $journal['id'])
                ->where('is_published', 1)
                ->orderBy('created_at', 'DESC')
                ->findAll(3);
        }

        $data = [
            'title'   => $journal['title'],
            'journal' => $journal,
            'related' => $related,
        ];

        return view('journal/partials/show', $data);
    }
}
