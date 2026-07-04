<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificationModel extends Model
{
    protected $table            = 'certifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'issuer',
        'issue_year',
        'description',
        'images_path',
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'name'       => 'required|max_length[150]',
        'issuer'     => 'permit_empty|max_length[150]',
        'issue_year' => 'permit_empty|integer|greater_than[1900]|less_than_equal_to[2100]',
        'description'=> 'permit_empty',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama sertifikasi harus diisi.',
            'max_length' => 'Nama sertifikasi maksimal 150 karakter.',
        ],
        'issue_year' => [
            'integer'           => 'Tahun terbit harus berupa angka.',
            'greater_than'      => 'Tahun terbit tidak valid (min 1900).',
            'less_than_equal_to'=> 'Tahun terbit tidak valid (maks 2100).',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['encodeImages'];
    protected $beforeUpdate   = ['encodeImages'];
    protected $afterFind      = ['decodeImages'];

    // -------------------------------------------------------------------------
    // Callbacks
    // -------------------------------------------------------------------------

    protected function encodeImages(array $data): array
    {
        if (isset($data['data']['images_path']) && is_array($data['data']['images_path'])) {
            $data['data']['images_path'] = json_encode($data['data']['images_path']);
        }

        return $data;
    }

    protected function decodeImages(array $data): array
    {
        if (empty($data['data'])) {
            return $data;
        }

        // findAll() returns a list; find($id) returns a single associative array
        if (array_is_list($data['data'])) {
            foreach ($data['data'] as &$row) {
                $row['images_path'] = $this->jsonDecodeField($row['images_path'] ?? null);
            }
            unset($row);
        } else {
            $data['data']['images_path'] = $this->jsonDecodeField($data['data']['images_path'] ?? null);
        }

        return $data;
    }

    // -------------------------------------------------------------------------
    // Query helpers
    // -------------------------------------------------------------------------

    public function getCertificationsByYear(int|string $year): array
    {
        return $this->where('issue_year', $year)->orderBy('name', 'ASC')->findAll();
    }

    public function getCertificationsByIssuer(string $issuer): array
    {
        return $this->like('issuer', $issuer)->orderBy('issue_year', 'DESC')->findAll();
    }

    public function searchCertifications(string $keyword): array
    {
        return $this->groupStart()
                    ->like('name', $keyword)
                    ->orLike('issuer', $keyword)
                    ->orLike('description', $keyword)
                    ->groupEnd()
                    ->orderBy('issue_year', 'DESC')
                    ->findAll();
    }

    public function getAllOrderedByYear(): array
    {
        return $this->orderBy('issue_year', 'DESC')->orderBy('name', 'ASC')->findAll();
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function jsonDecodeField(mixed $value): array
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }

        return is_array($value) ? $value : [];
    }
}