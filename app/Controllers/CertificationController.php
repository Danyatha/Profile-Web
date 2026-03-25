<?php

namespace App\Controllers;

use App\Models\CertificationModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * CertificationController
 *
 * REST resource controller. Images are stored as a JSON array via
 * CertificationModel callbacks (encodeImages / decodeImages).
 */
class CertificationController extends ResourceController
{
    protected $modelName = CertificationModel::class;
    protected $format    = 'json';

    private const UPLOAD_DIR = 'certifications';

    public function __construct()
    {
        helper(['form', 'url']);
    }

    // GET /certifications
    public function index()
    {
        return $this->respond([
            'status' => 'success',
            'data'   => $this->model->findAll(),
        ]);
    }

    // GET /certifications/:id
    public function show($id = null)
    {
        $cert = $this->findOrFail($id);

        return $this->respond(['status' => 'success', 'data' => $cert]);
    }

    // POST /certifications
    public function create()
    {
        $data = [
            'name'        => $this->request->getPost('name'),
            'issuer'      => $this->request->getPost('issuer'),
            'issue_year'  => $this->request->getPost('issue_year'),
            'description' => $this->request->getPost('description'),
        ];

        $uploaded = $this->handleImageUploads();
        if ($uploaded) {
            $data['images_path'] = $uploaded;
        }

        if (! $this->model->insert($data)) {
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated([
            'status'  => 'success',
            'message' => 'Sertifikasi berhasil ditambahkan',
            'data'    => $this->model->find($this->model->getInsertID()),
        ]);
    }

    // PUT/PATCH /certifications/:id
    public function update($id = null)
    {
        $cert = $this->findOrFail($id);

        // Accept both raw-input (PUT) and form-data (PATCH)
        $raw  = $this->request->getRawInput();

        $data = [
            'name'        => $raw['name']        ?? $cert['name'],
            'issuer'      => $raw['issuer']       ?? $cert['issuer'],
            'issue_year'  => $raw['issue_year']   ?? $cert['issue_year'],
            'description' => $raw['description']  ?? $cert['description'],
        ];

        $uploaded = $this->handleImageUploads();
        if ($uploaded) {
            $data['images_path'] = $uploaded;
        }

        if (! $this->model->update($id, $data)) {
            return $this->fail($this->model->errors());
        }

        return $this->respond([
            'status'  => 'success',
            'message' => 'Sertifikasi berhasil diupdate',
            'data'    => $this->model->find($id),
        ]);
    }

    // DELETE /certifications/:id
    public function delete($id = null)
    {
        $cert = $this->findOrFail($id);

        $this->purgeImages($cert['images_path'] ?? []);

        if (! $this->model->delete($id)) {
            return $this->fail('Gagal menghapus sertifikasi');
        }

        return $this->respondDeleted([
            'status'  => 'success',
            'message' => 'Sertifikasi berhasil dihapus',
        ]);
    }

    // GET /certifications/search?q=keyword
    public function search()
    {
        $keyword = $this->request->getGet('q');

        if (! $keyword) {
            return $this->fail('Keyword pencarian tidak boleh kosong');
        }

        return $this->respond([
            'status' => 'success',
            'data'   => $this->model->searchCertifications($keyword),
        ]);
    }

    // GET /certifications/year/:year
    public function getByYear($year = null)
    {
        return $this->respond([
            'status' => 'success',
            'data'   => $this->model->getCertificationsByYear($year),
        ]);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /** Process multi-file upload, return array of stored paths (or empty). */
    private function handleImageUploads(): array
    {
        $files   = $this->request->getFiles();
        $results = [];

        if (empty($files['images'])) {
            return $results;
        }

        $destDir = WRITEPATH . 'uploads/' . self::UPLOAD_DIR;

        foreach ($files['images'] as $image) {
            if ($image->isValid() && ! $image->hasMoved()) {
                $newName   = $image->getRandomName();
                $image->move($destDir, $newName);
                $results[] = 'uploads/' . self::UPLOAD_DIR . '/' . $newName;
            }
        }

        return $results;
    }

    /** Delete image files from disk. */
    private function purgeImages(array $paths): void
    {
        foreach ($paths as $path) {
            $full = WRITEPATH . $path;
            if (file_exists($full)) {
                unlink($full);
            }
        }
    }

    /** Return record or respond with 404. */
    private function findOrFail(int|string|null $id): array
    {
        $record = $this->model->find($id);

        if (! $record) {
            throw new PageNotFoundException('Sertifikasi tidak ditemukan');
        }

        return $record;
    }
}
