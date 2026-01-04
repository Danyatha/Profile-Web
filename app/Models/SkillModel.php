<?php

namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table            = 'skills';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['skill_name', 'category', 'description', 'image_path'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'skill_name' => 'required|max_length[100]',
        'category'   => 'required|max_length[100]',
        'description' => 'permit_empty|max_length[255]',
    ];
    protected $validationMessages   = [
        'skill_name' => [
            'required'    => 'Nama skill harus diisi',
            'max_length'  => 'Nama skill maksimal 100 karakter'
        ],
        'category' => [
            'required'    => 'Kategori harus diisi',
            'max_length'  => 'Kategori maksimal 100 karakter'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Custom methods
    public function getSkillsByCategory($category)
    {
        return $this->where('category', $category)->findAll();
    }

    public function searchSkills($keyword)
    {
        return $this->like('skill_name', $keyword)
            ->orLike('category', $keyword)
            ->orLike('description', $keyword)
            ->findAll();
    }
    public function getSkillById($id)
    {
        $skill = $this->find($id);
        if ($skill) {
            $skill['description'] = nl2br($skill['description']);
            $skill['category'] = explode(',', $skill['category']);
            $skill['skill_name'] = explode(',', $skill['skill_name']);
        }
        return $skill;
    }
}
