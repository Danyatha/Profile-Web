<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'name',
        'image',
        'description',
        'years',
        'details',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'image' => 'required|valid_url',
        'description' => 'required|min_length[10]',
        'years' => 'required|integer',
        'details' => 'required|min_length[10]',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 3 characters long',
            'max_length' => 'Name cannot exceed 255 characters',
        ],
        'image' => [
            'required' => 'Image URL is required',
            'valid_url' => 'Image must be a valid URL',
        ],
        'description' => [
            'required' => 'Description is required',
            'min_length' => 'Description must be at least 10 characters long',
        ],
        'years' => [
            'required' => 'Years of experience is required',
            'integer' => 'Years of experience must be an integer',
        ],
        'details' => [
            'required' => 'Details are required',
            'min_length' => 'Details must be at least 10 characters long',
        ],
    ];
}
