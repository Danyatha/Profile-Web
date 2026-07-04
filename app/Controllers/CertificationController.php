<?php

namespace App\Controllers;

use App\Models\CertificationModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * CertificationController
 *
 * Handles admin CRUD for Certifications.
 * Images are stored as a JSON array by CertificationModel callbacks.
 *
 * Routes (add to app/Config/Routes.php inside the 'admin' group):
 *
 *   $routes->group('certificates', function ($routes) {
 *       $routes->get('/',              'CertificationController::index');
 *       $routes->get('create',         'CertificationController::create');
 *       $routes->post('store',         'CertificationController::store');
 *       $routes->get('show/(:num)',    'CertificationController::show/$1');
 *       $routes->get('edit/(:num)',    'CertificationController::edit/$1');
 *       $routes->post('update/(:num)', 'CertificationController::update/$1');
 *       $routes->get('delete/(:num)',  'CertificationController::delete/$1');
 *       $routes->post('delete/(:num)', 'CertificationController::delete/$1');
 *       $routes->post('delete-image',  'CertificationController::deleteImage');
 *   });
 */
class CertificationController extends Controller
{
    private CertificationModel $model;

    /** Folder name inside public/uploads/ */
    private const UPLOAD_DIR = 'certifications';

    /** Allowed MIME types for uploaded images */
    private const ALLOWED_MIME = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    /** Max single-file size in KB */
    private const MAX_FILE_KB = 2048;

    public function __construct()
    {
        $this->model = new CertificationModel();
        helper(['form', 'url', 'filesystem']);
    }

    // =========================================================================
    // READ
    // =========================================================================

    /**
     * GET admin/certificates
     * List all certifications ordered by year DESC.
     */
    public function index()
    {
        $data = [
            'title'          => 'Kelola Sertifikasi',
            'certifications' => $this->model->getAllOrderedByYear(),
        ];
        
        return view('control/certification-index', $data);
    }

    /**
     * GET admin/certificates/show/:id
     * Detail satu sertifikasi.
     */
    public function show(int $id)
    {
        return view('control/certification/show', [
            'title'         => 'Detail Sertifikasi',
            'certification' => $this->findOrFail($id),
        ]);
    }

    // =========================================================================
    // CREATE
    // =========================================================================

    /**
     * GET admin/certificates/create
     */
    public function create()
    {
        return view('control/certification/create', [
            'title'      => 'Tambah Sertifikasi',
            'validation' => \Config\Services::validation(),
        ]);
    }

    /**
     * POST admin/certificates/store
     */
    public function store()
    {
        $data = $this->collectFormData();

        // Handle uploads; bail on error
        [$paths, $uploadError] = $this->handleImageUploads();
        if ($uploadError) {
            return $this->jsonError($uploadError, 422);
        }
        if ($paths) {
            $data['images_path'] = $paths;
        }

        if (! $this->model->insert($data)) {
            return $this->jsonError($this->model->errors(), 422);
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Sertifikasi berhasil ditambahkan.',
                'data'    => $this->model->find($this->model->getInsertID()),
            ]);
        }

        return redirect()->to(base_url('admin/certificates'))
                         ->with('success', 'Sertifikasi berhasil ditambahkan.');
    }

    // =========================================================================
    // UPDATE
    // =========================================================================

    /**
     * GET admin/certificates/edit/:id
     */
    public function edit(int $id)
    {
        return view('control/certification/edit', [
            'title'         => 'Edit Sertifikasi',
            'certification' => $this->findOrFail($id),
            'validation'    => \Config\Services::validation(),
        ]);
    }

    /**
     * POST admin/certificates/update/:id
     */
    public function update(int $id)
    {
        $cert = $this->findOrFail($id);
        $data = $this->collectFormData($cert);   // fall back to existing values

        // New uploads? Append to existing paths.
        [$newPaths, $uploadError] = $this->handleImageUploads();
        if ($uploadError) {
            return $this->jsonError($uploadError, 422);
        }
        if ($newPaths) {
            $existing = $cert['images_path'] ?? [];
            $data['images_path'] = array_values(array_unique(array_merge($existing, $newPaths)));
        }

        if (! $this->model->update($id, $data)) {
            return $this->jsonError($this->model->errors(), 422);
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Sertifikasi berhasil diperbarui.',
                'data'    => $this->model->find($id),
            ]);
        }

        return redirect()->to(base_url('admin/certificates/show/' . $id))
                         ->with('success', 'Sertifikasi berhasil diperbarui.');
    }

    // =========================================================================
    // DELETE
    // =========================================================================

    /**
     * GET|POST admin/certificates/delete/:id
     * Supports both browser redirect and AJAX JSON response.
     */
    public function delete(int $id)
    {
        $cert = $this->findOrFail($id);

        // Purge all image files
        $this->purgeImages($cert['images_path'] ?? []);

        if (! $this->model->delete($id)) {
            if ($this->request->isAJAX()) {
                return $this->jsonError('Gagal menghapus sertifikasi.', 500);
            }
            return redirect()->back()->with('error', 'Gagal menghapus sertifikasi.');
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Sertifikasi berhasil dihapus.',
            ]);
        }

        return redirect()->to(base_url('admin/certificates'))
                         ->with('success', 'Sertifikasi berhasil dihapus.');
    }

    /**
     * POST admin/certificates/delete-image
     * Remove a single image from a certification record (AJAX).
     *
     * Body params:
     *   cert_id  – certification ID
     *   path     – relative path like "uploads/certifications/abc123.jpg"
     */
    public function deleteImage()
    {
        $certId = (int) $this->request->getPost('cert_id');
        $path   = $this->request->getPost('path');

        if (! $certId || ! $path) {
            return $this->jsonError('Parameter tidak lengkap.', 400);
        }

        $cert   = $this->findOrFail($certId);
        $images = $cert['images_path'] ?? [];

        if (! in_array($path, $images, true)) {
            return $this->jsonError('Gambar tidak ditemukan pada record ini.', 404);
        }

        // Remove file from disk
        $full = FCPATH . $path;
        if (file_exists($full)) {
            unlink($full);
        }

        // Save updated list
        $images = array_values(array_filter($images, fn ($p) => $p !== $path));
        $this->model->update($certId, ['images_path' => $images]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Gambar berhasil dihapus.',
        ]);
    }

    // =========================================================================
    // Private helpers
    // =========================================================================

    /**
     * Collect and sanitize POST fields.
     * When $existing is provided, missing fields fall back to existing values.
     */
    private function collectFormData(array $existing = []): array
    {
        return [
            'name'        => $this->request->getPost('name')        ?? $existing['name']        ?? '',
            'issuer'      => $this->request->getPost('issuer')       ?? $existing['issuer']       ?? null,
            'issue_year'  => $this->request->getPost('issue_year')   ?? $existing['issue_year']   ?? null,
            'description' => $this->request->getPost('description')  ?? $existing['description']  ?? null,
        ];
    }

    /**
     * Process multi-file upload from the "images[]" field.
     * Returns [paths[], errorString|null].
     */
    private function handleImageUploads(): array
    {
        $files   = $this->request->getFiles();
        $results = [];

        if (empty($files['images'])) {
            return [$results, null];
        }

        $destDir = FCPATH . 'uploads/' . self::UPLOAD_DIR;
        if (! is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        foreach ($files['images'] as $image) {
            // Skip the phantom "empty" entry browsers sometimes send
            if (! $image->isValid() || $image->getError() === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            if ($image->hasMoved()) {
                continue;
            }

            // Validate MIME
            if (! in_array($image->getMimeType(), self::ALLOWED_MIME, true)) {
                return [[], 'Tipe file tidak didukung: ' . $image->getClientMimeType()];
            }

            // Validate size
            if ($image->getSizeByUnit('kb') > self::MAX_FILE_KB) {
                return [[], 'Ukuran file melebihi batas ' . self::MAX_FILE_KB . ' KB.'];
            }

            $newName = $image->getRandomName();
            $image->move($destDir, $newName);
            $results[] = 'uploads/' . self::UPLOAD_DIR . '/' . $newName;
        }

        return [$results, null];
    }

    /** Delete image files from disk. */
    private function purgeImages(array $paths): void
    {
        foreach ($paths as $path) {
            $full = FCPATH . $path;
            if (file_exists($full)) {
                unlink($full);
            }
        }
    }

    /**
     * Return a record or throw 404.
     * @throws PageNotFoundException
     */
    private function findOrFail(int $id): array
    {
        $record = $this->model->find($id);
        if (! $record) {
            throw new PageNotFoundException("Sertifikasi dengan ID {$id} tidak ditemukan.");
        }

        return $record;
    }

    /** Shortcut to return a JSON error response. */
    private function jsonError(array|string $messages, int $statusCode = 400)
    {
        return $this->response
                    ->setStatusCode($statusCode)
                    ->setJSON([
                        'status'   => 'error',
                        'message'  => is_string($messages) ? $messages : implode(' ', $messages),
                        'messages' => $messages,
                    ]);
    }
}