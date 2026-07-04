<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JournalModel;
use CodeIgniter\HTTP\RedirectResponse;


class JournalController extends BaseController
{
    protected JournalModel $model;

    // Konfigurasi upload gambar
    private const UPLOAD_PATH      = 'uploads/journal/';
    private const ALLOWED_TYPES    = ['image/jpeg', 'image/png', 'image/webp'];
    private const MAX_SIZE_KB      = 2048; // 2 MB

    // Konfigurasi upload dokumen lampiran
    private const DOC_PATH         = 'uploads/journal/documents/';
    private const DOC_TYPES        = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    ];
    private const DOC_MAX_KB       = 10240; // 10 MB

    public function __construct()
    {
        $this->model = new JournalModel();
        helper(['form', 'url', 'text']);
    }

    // ----------------------------------------------------------------
    // INDEX — Daftar semua jurnal (termasuk draft)
    // ----------------------------------------------------------------
    public function index(): string
    {
        $search  = $this->request->getGet('search');
        $perPage = 15;

        $builder = $this->model->withDeleted();

        if ($search) {
            $builder = $builder->groupStart()
                ->like('title', $search)
                ->orLike('category', $search)
                ->groupEnd();
        }

        $journals = $builder->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'journals');

        $data = [
            'title'    => 'Kelola Journal',
            'journals' => $journals,
            'pager'    => $this->model->pager,
            'search'   => $search,
        ];

        return view('control/journal-index', $data);
    }

    // ----------------------------------------------------------------
    // CREATE — Form tambah jurnal
    // ----------------------------------------------------------------
    public function create(): string
    {
        $data = [
            'title'      => 'Tambah Journal',
            'categories' => $this->model->getCategories(),
            'validation' => \Config\Services::validation(),
        ];

        return view('control/journal/create', $data);
    }

    // ----------------------------------------------------------------
    // STORE — Simpan jurnal baru
    // ----------------------------------------------------------------
    public function store(): RedirectResponse
    {
        // Validasi input
        if (!$this->validate($this->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');
        $slug  = $this->model->makeSlug($title);

        // Handle upload cover image
        $coverImage = null;
        $file       = $this->request->getFile('cover_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadResult = $this->uploadImage($file);

            if ($uploadResult['error']) {
                return redirect()->back()->withInput()->with('error', $uploadResult['message']);
            }

            $coverImage = $uploadResult['path'];
        }

        // Handle upload dokumen lampiran
        $docFile = null;
        $docName = null;
        $docType = null;
        $doc     = $this->request->getFile('document_file');

        if ($doc && $doc->isValid() && !$doc->hasMoved()) {
            $docResult = $this->uploadDocument($doc);
            if ($docResult['error']) {
                return redirect()->back()->withInput()->with('error', $docResult['message']);
            }
            $docFile = $docResult['path'];
            $docName = $docResult['name'];
            $docType = $docResult['type'];
        }

        $this->model->insert([
            'title'         => $title,
            'slug'          => $slug,
            'category'      => $this->request->getPost('category') ?: null,
            'content'       => $this->request->getPost('content'),
            'cover_image'   => $coverImage,
            'document_file' => $docFile,
            'document_name' => $docName,
            'document_type' => $docType,
            'is_published'  => (int) $this->request->getPost('is_published'),
        ]);

        return redirect()->to(base_url('admin/journals'))
            ->with('success', 'Jurnal berhasil ditambahkan!');
    }

    // ----------------------------------------------------------------
    // EDIT — Form edit jurnal
    // ----------------------------------------------------------------
    public function edit(int $id): string|RedirectResponse
    {
        $journal = $this->model->withDeleted()->find($id);

        if (!$journal) {
            return redirect()->to(base_url('admin/journals'))
                ->with('error', 'Jurnal tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Journal',
            'journal'    => $journal,
            'categories' => $this->model->getCategories(),
            'validation' => \Config\Services::validation(),
        ];

        return view('control/journal/create', $data);
    }

    // ----------------------------------------------------------------
    // UPDATE — Simpan perubahan jurnal
    // ----------------------------------------------------------------
    public function update(int $id): RedirectResponse
    {
        $journal = $this->model->find($id);

        if (!$journal) {
            return redirect()->to(base_url('admin/journals'))
                ->with('error', 'Jurnal tidak ditemukan.');
        }

        // Validasi (slug dikecualikan dari unique check untuk ID ini)
        $rules = $this->getValidationRules($id);
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');

        // Re-generate slug hanya kalau title berubah
        $slug = ($journal['title'] !== $title)
            ? $this->model->makeSlug($title, $id)
            : $journal['slug'];

        // Handle upload cover image baru
        $coverImage = $journal['cover_image']; // default: pakai yang lama
        $file       = $this->request->getFile('cover_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadResult = $this->uploadImage($file);

            if ($uploadResult['error']) {
                return redirect()->back()->withInput()->with('error', $uploadResult['message']);
            }

            // Hapus gambar lama jika ada
            $this->deleteImage($journal['cover_image']);
            $coverImage = $uploadResult['path'];
        }

        // Hapus gambar jika user centang "hapus cover"
        if ($this->request->getPost('remove_cover') && $coverImage) {
            $this->deleteImage($coverImage);
            $coverImage = null;
        }

        // Default: pertahankan dokumen lama
        $docFile = $journal['document_file'];
        $docName = $journal['document_name'];
        $docType = $journal['document_type'];

        $doc = $this->request->getFile('document_file');
        if ($doc && $doc->isValid() && !$doc->hasMoved()) {
            $docResult = $this->uploadDocument($doc);
            if ($docResult['error']) {
                return redirect()->back()->withInput()->with('error', $docResult['message']);
            }
            $this->deleteDocument($journal['document_file']); // hapus lama
            $docFile = $docResult['path'];
            $docName = $docResult['name'];
            $docType = $docResult['type'];
        }

        // Hapus dokumen jika user centang "hapus dokumen"
        if ($this->request->getPost('remove_document') && $docFile) {
            $this->deleteDocument($docFile);
            $docFile = $docName = $docType = null;
        }

        $this->model->update($id, [
            'title'         => $title,
            'slug'          => $slug,
            'category'      => $this->request->getPost('category') ?: null,
            'content'       => $this->request->getPost('content'),
            'cover_image'   => $coverImage,
            'document_file' => $docFile,
            'document_name' => $docName,
            'document_type' => $docType,
            'is_published'  => (int) $this->request->getPost('is_published'),
        ]);

        return redirect()->to(base_url('admin/journals'))
            ->with('success', 'Jurnal berhasil diperbarui!');
    }

    // ----------------------------------------------------------------
    // DELETE — Soft delete jurnal
    // ----------------------------------------------------------------
    public function delete(int $id): RedirectResponse
    {
        $journal = $this->model->find($id);

        if (!$journal) {
            return redirect()->to(base_url('admin/journals'))
                ->with('error', 'Jurnal tidak ditemukan.');
        }

        $this->model->delete($id); // soft delete

        return redirect()->to(base_url('admin/journals'))
            ->with('success', 'Jurnal berhasil dihapus (soft delete).');
    }

    // ----------------------------------------------------------------
    // RESTORE — Pulihkan soft-deleted jurnal
    // ----------------------------------------------------------------
    public function restore(int $id): RedirectResponse
    {
        $journal = $this->model->withDeleted()->find($id);

        if (!$journal || empty($journal['deleted_at'])) {
            return redirect()->to(base_url('admin/journals'))
                ->with('error', 'Jurnal tidak ditemukan atau belum dihapus.');
        }

        $this->model->update($id, ['deleted_at' => null]);

        return redirect()->to(base_url('admin/journals'))
            ->with('success', 'Jurnal berhasil dipulihkan.');
    }

    // ----------------------------------------------------------------
    // FORCE DELETE — Hapus permanen beserta gambar & dokumennya
    // ----------------------------------------------------------------
    public function forceDelete(int $id): RedirectResponse
    {
        $journal = $this->model->withDeleted()->find($id);

        if (!$journal) {
            return redirect()->to(base_url('admin/journals'))
                ->with('error', 'Jurnal tidak ditemukan.');
        }

        $this->deleteImage($journal['cover_image']);
        $this->deleteDocument($journal['document_file']);
        $this->model->delete($id, true); // force delete

        return redirect()->to(base_url('admin/journals'))
            ->with('success', 'Jurnal dihapus permanen.');
    }

    // ----------------------------------------------------------------
    // TOGGLE PUBLISH — Ubah status published/draft
    // ----------------------------------------------------------------
    public function togglePublish(int $id): RedirectResponse
    {
        $journal = $this->model->find($id);

        if (!$journal) {
            return redirect()->to(base_url('admin/journals'))
                ->with('error', 'Jurnal tidak ditemukan.');
        }

        $newStatus = $journal['is_published'] ? 0 : 1;
        $this->model->update($id, ['is_published' => $newStatus]);

        $msg = $newStatus ? 'Jurnal dipublish.' : 'Jurnal dijadikan draft.';

        return redirect()->to(base_url('admin/journals'))->with('success', $msg);
    }

    // ----------------------------------------------------------------
    // HELPERS PRIVATE
    // ----------------------------------------------------------------

    /**
     * Upload dokumen lampiran ke folder public/uploads/journal/documents/.
     * Return array ['error' => bool, 'message' => string, 'path', 'name', 'type'].
     */
    private function uploadDocument($file): array
    {
        if (!in_array($file->getMimeType(), self::DOC_TYPES)) {
            return ['error' => true, 'message' => 'Tipe dokumen tidak diizinkan (PDF/DOC/XLS/PPT).', 'path' => '', 'name' => '', 'type' => ''];
        }
        if ($file->getSizeByUnit('kb') > self::DOC_MAX_KB) {
            return ['error' => true, 'message' => 'Ukuran dokumen maksimal 10MB.', 'path' => '', 'name' => '', 'type' => ''];
        }

        $original = $file->getClientName();
        $ext      = strtolower($file->getClientExtension() ?: $file->getExtension());
        $newName  = $file->getRandomName();
        $file->move(FCPATH . self::DOC_PATH, $newName);

        return [
            'error'   => false,
            'message' => 'Upload berhasil.',
            'path'    => self::DOC_PATH . $newName,
            'name'    => $original,
            'type'    => $ext,
        ];
    }

    /**
     * Hapus file dokumen dari disk jika ada.
     */
    private function deleteDocument(?string $path): void
    {
        if ($path && file_exists(FCPATH . $path)) {
            unlink(FCPATH . $path);
        }
    }

    /**
     * Upload gambar cover ke folder public/uploads/journal/.
     * Return array ['error' => bool, 'message' => string, 'path' => string].
     */
    private function uploadImage($file): array
    {
        // Validasi tipe file
        if (!in_array($file->getMimeType(), self::ALLOWED_TYPES)) {
            return ['error' => true, 'message' => 'Format gambar tidak valid. Gunakan JPG, PNG, atau WEBP.', 'path' => ''];
        }

        // Validasi ukuran
        if ($file->getSizeByUnit('kb') > self::MAX_SIZE_KB) {
            return ['error' => true, 'message' => 'Ukuran gambar maksimal 2MB.', 'path' => ''];
        }

        $newName = $file->getRandomName();
        $file->move(FCPATH . self::UPLOAD_PATH, $newName);

        return [
            'error'   => false,
            'message' => 'Upload berhasil.',
            'path'    => self::UPLOAD_PATH . $newName,
        ];
    }

    /**
     * Hapus file gambar dari disk jika ada.
     */
    private function deleteImage(?string $path): void
    {
        if ($path && file_exists(FCPATH . $path)) {
            unlink(FCPATH . $path);
        }
    }

    /**
     * Aturan validasi form.
     * $excludeId digunakan agar slug unik mengecualikan record saat ini.
     */
    private function getValidationRules(int $excludeId = 0): array
    {
        return [
            'title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required'   => 'Title wajib diisi.',
                    'min_length' => 'Title minimal 3 karakter.',
                ],
            ],
            'content' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'Konten wajib diisi.',
                    'min_length' => 'Konten minimal 10 karakter.',
                ],
            ],
            'category' => [
                'rules' => 'permit_empty|max_length[100]',
            ],
            'cover_image' => [
                'rules' => 'permit_empty|is_image[cover_image]|max_dims[cover_image,4000,4000]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                ],
            ],
        ];
    }
}