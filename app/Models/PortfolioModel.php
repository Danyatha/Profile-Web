<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $table = 'portfolios';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'title',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'image' => 'required|valid_url',
        'description' => 'required|min_length[10]',
    ];
    protected $validationMessages = [
        'title' => [
            'required' => 'Title is required',
            'min_length' => 'Title must be at least 3 characters long',
            'max_length' => 'Title cannot exceed 255 characters',
        ],
        'image' => [
            'required' => 'Image URL is required',
            'valid_url' => 'Image must be a valid URL',
        ],
        'description' => [
            'required' => 'Description is required',
            'min_length' => 'Description must be at least 10 characters long',
        ],
    ];
}
