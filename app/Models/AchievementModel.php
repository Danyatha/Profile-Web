<?php

namespace App\Models;

use CodeIgniter\Model;

class AchievementModel extends Model
{
    protected $table            = 'achievements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'event_name',
        'achievement',
        'description',
        'start_date',
        'end_date',
        'images_path'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'title'       => 'required|min_length[3]|max_length[150]',
        'event_name'  => 'required|min_length[3]|max_length[150]',
        'achievement' => 'required|min_length[3]|max_length[100]',
        'description' => 'permit_empty',
        'start_date'  => 'permit_empty|valid_date',
        'end_date'    => 'permit_empty|valid_date',
    ];

    protected $validationMessages   = [
        'title' => [
            'required'   => 'Title harus diisi',
            'min_length' => 'Title minimal 3 karakter',
            'max_length' => 'Title maksimal 150 karakter',
        ],
        'event_name' => [
            'required'   => 'Nama event harus diisi',
            'min_length' => 'Nama event minimal 3 karakter',
        ],
        'achievement' => [
            'required'   => 'Achievement harus diisi',
            'min_length' => 'Achievement minimal 3 karakter',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
