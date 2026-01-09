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
        'images_path'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|max_length[150]',
        'issuer' => 'permit_empty|max_length[150]',
        'issue_year' => 'permit_empty|valid_year',
        'description' => 'permit_empty',
        'images_path' => 'permit_empty|valid_json'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama sertifikasi harus diisi',
            'max_length' => 'Nama sertifikasi maksimal 150 karakter'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['encodeImages'];
    protected $beforeUpdate   = ['encodeImages'];
    protected $afterFind      = ['decodeImages'];

    // Encode images_path to JSON before insert/update
    protected function encodeImages(array $data)
    {
        if (isset($data['data']['images_path']) && is_array($data['data']['images_path'])) {
            $data['data']['images_path'] = json_encode($data['data']['images_path']);
        }
        return $data;
    }

    // Decode images_path from JSON after find
    protected function decodeImages(array $data)
    {
        if (isset($data['data'])) {
            if (is_array($data['data'])) {
                foreach ($data['data'] as &$row) {
                    if (isset($row['images_path']) && is_string($row['images_path'])) {
                        $row['images_path'] = json_decode($row['images_path'], true);
                    }
                }
            } else {
                if (isset($data['data']['images_path']) && is_string($data['data']['images_path'])) {
                    $data['data']['images_path'] = json_decode($data['data']['images_path'], true);
                }
            }
        }
        return $data;
    }

    // Custom methods
    public function getCertificationsByYear($year)
    {
        return $this->where('issue_year', $year)->findAll();
    }

    public function getCertificationsByIssuer($issuer)
    {
        return $this->like('issuer', $issuer)->findAll();
    }

    public function searchCertifications($keyword)
    {
        return $this->groupStart()
            ->like('name', $keyword)
            ->orLike('issuer', $keyword)
            ->orLike('description', $keyword)
            ->groupEnd()
            ->findAll();
    }
}
