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

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    // Note: 'valid_year' and 'valid_json' are custom rules; register them in
    //       app/Config/Validation.php or replace with built-in alternatives.
    protected $validationRules = [
        'name'        => 'required|max_length[150]',
        'issuer'      => 'permit_empty|max_length[150]',
        'issue_year'  => 'permit_empty|integer|greater_than[1900]|less_than_equal_to[2100]',
        'description' => 'permit_empty',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama sertifikasi harus diisi',
            'max_length' => 'Nama sertifikasi maksimal 150 karakter',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks: encode before write, decode after read
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
        if (! isset($data['data'])) {
            return $data;
        }

        // findAll returns a list; find returns a single row
        if (isset($data['data'][0])) {
            foreach ($data['data'] as &$row) {
                $row['images_path'] = $this->jsonDecodeField($row['images_path'] ?? null);
            }
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
        return $this->where('issue_year', $year)->findAll();
    }

    public function getCertificationsByIssuer(string $issuer): array
    {
        return $this->like('issuer', $issuer)->findAll();
    }

    public function searchCertifications(string $keyword): array
    {
        return $this->groupStart()
            ->like('name', $keyword)
            ->orLike('issuer', $keyword)
            ->orLike('description', $keyword)
            ->groupEnd()
            ->findAll();
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
