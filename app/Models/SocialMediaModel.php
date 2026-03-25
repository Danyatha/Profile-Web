<?php

namespace App\Models;

use CodeIgniter\Model;

class SocialMediaModel extends Model
{
    protected $table            = 'social_media';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'platform_name',
        'profile_url',
        'icon_class',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';  // was missing in original

    // Validation
    protected $validationRules = [
        'platform_name' => 'required|max_length[100]',
        'profile_url'   => 'required|valid_url|max_length[255]',
    ];

    protected $validationMessages = [
        'platform_name' => [
            'required'   => 'Nama platform harus diisi',
            'max_length' => 'Nama platform maksimal 100 karakter',
        ],
        'profile_url' => [
            'required'   => 'URL profil harus diisi',
            'valid_url'  => 'URL profil tidak valid',
            'max_length' => 'URL profil maksimal 255 karakter',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
