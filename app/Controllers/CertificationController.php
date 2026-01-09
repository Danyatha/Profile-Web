<?php

namespace App\Controllers;

use App\Models\CertificationModel;
use CodeIgniter\RESTful\ResourceController;

class Certifications extends ResourceController
{
    protected $modelName = 'App\Models\CertificationModel';
    protected $format    = 'json';

    public function __construct()
    {
        helper(['form', 'url']);
    }

    // GET /certifications - List all certifications
    public function index()
    {
        $certifications = $this->model->findAll();

        return $this->respond([
            'status' => 'success',
            'data' => $certifications
        ]);
    }

    // GET /certifications/:id - Get single certification
    public function show($id = null)
    {
        $certification = $this->model->find($id);

        if (!$certification) {
            return $this->failNotFound('Sertifikasi tidak ditemukan');
        }

        return $this->respond([
            'status' => 'success',
            'data' => $certification
        ]);
    }

    // POST /certifications - Create new certification
    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'issuer' => $this->request->getPost('issuer'),
            'issue_year' => $this->request->getPost('issue_year'),
            'description' => $this->request->getPost('description'),
        ];

        // Handle file upload
        $images = $this->request->getFiles();
        if ($images && isset($images['images'])) {
            $uploadedImages = [];
            foreach ($images['images'] as $image) {
                if ($image->isValid() && !$image->hasMoved()) {
                    $newName = $image->getRandomName();
                    $image->move(WRITEPATH . 'uploads/certifications', $newName);
                    $uploadedImages[] = 'uploads/certifications/' . $newName;
                }
            }
            if (!empty($uploadedImages)) {
                $data['images_path'] = $uploadedImages;
            }
        }

        if ($this->model->insert($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Sertifikasi berhasil ditambahkan',
                'data' => $this->model->find($this->model->getInsertID())
            ];
            return $this->respondCreated($response);
        }

        return $this->fail($this->model->errors());
    }

    // PUT/PATCH /certifications/:id - Update certification
    public function update($id = null)
    {
        $certification = $this->model->find($id);

        if (!$certification) {
            return $this->failNotFound('Sertifikasi tidak ditemukan');
        }

        $data = [
            'name' => $this->request->getRawInput()['name'] ?? $certification['name'],
            'issuer' => $this->request->getRawInput()['issuer'] ?? $certification['issuer'],
            'issue_year' => $this->request->getRawInput()['issue_year'] ?? $certification['issue_year'],
            'description' => $this->request->getRawInput()['description'] ?? $certification['description'],
        ];

        // Handle file upload for update
        $images = $this->request->getFiles();
        if ($images && isset($images['images'])) {
            $uploadedImages = [];
            foreach ($images['images'] as $image) {
                if ($image->isValid() && !$image->hasMoved()) {
                    $newName = $image->getRandomName();
                    $image->move(WRITEPATH . 'uploads/certifications', $newName);
                    $uploadedImages[] = 'uploads/certifications/' . $newName;
                }
            }
            if (!empty($uploadedImages)) {
                $data['images_path'] = $uploadedImages;
            }
        }

        if ($this->model->update($id, $data)) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Sertifikasi berhasil diupdate',
                'data' => $this->model->find($id)
            ]);
        }

        return $this->fail($this->model->errors());
    }

    // DELETE /certifications/:id - Delete certification
    public function delete($id = null)
    {
        $certification = $this->model->find($id);

        if (!$certification) {
            return $this->failNotFound('Sertifikasi tidak ditemukan');
        }

        // Delete associated images
        if (isset($certification['images_path']) && is_array($certification['images_path'])) {
            foreach ($certification['images_path'] as $imagePath) {
                $fullPath = WRITEPATH . $imagePath;
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                'status' => 'success',
                'message' => 'Sertifikasi berhasil dihapus'
            ]);
        }

        return $this->fail('Gagal menghapus sertifikasi');
    }

    // GET /certifications/search - Search certifications
    public function search()
    {
        $keyword = $this->request->getGet('q');

        if (!$keyword) {
            return $this->fail('Keyword pencarian tidak boleh kosong');
        }

        $results = $this->model->searchCertifications($keyword);

        return $this->respond([
            'status' => 'success',
            'data' => $results
        ]);
    }

    // GET /certifications/year/:year - Get by year
    public function getByYear($year = null)
    {
        $certifications = $this->model->getCertificationsByYear($year);

        return $this->respond([
            'status' => 'success',
            'data' => $certifications
        ]);
    }
}
