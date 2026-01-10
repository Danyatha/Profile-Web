<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $table            = 'portfolios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'project_name',
        'description',
        'technologies_used',
        'project_url',
        'images_path'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'project_name' => 'required|min_length[3]|max_length[150]',
        'description'  => 'permit_empty',
        'technologies_used' => 'permit_empty|max_length[255]',
        'project_url'  => 'permit_empty|valid_url|max_length[255]',
        'images_path'  => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'project_name' => [
            'required'    => 'Nama project harus diisi',
            'min_length'  => 'Nama project minimal 3 karakter',
            'max_length'  => 'Nama project maksimal 150 karakter',
        ],
        'project_url' => [
            'valid_url' => 'URL project tidak valid',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Custom methods
    public function getAllPortfolios()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getPortfolioById($id)
    {
        return $this->find($id);
    }

    public function searchPortfolios($keyword)
    {
        return $this->like('project_name', $keyword)
            ->orLike('description', $keyword)
            ->orLike('technologies_used', $keyword)
            ->findAll();
    }
}
