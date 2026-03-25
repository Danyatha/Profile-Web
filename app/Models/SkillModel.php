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
    protected $allowedFields    = [
        'skill_name',
        'category',
        'description',
        'image_path',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'skill_name'  => 'required|max_length[100]',
        'category'    => 'required|max_length[100]',
        'description' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'skill_name' => [
            'required'   => 'Nama skill harus diisi',
            'max_length' => 'Nama skill maksimal 100 karakter',
        ],
        'category' => [
            'required'   => 'Kategori harus diisi',
            'max_length' => 'Kategori maksimal 100 karakter',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // -------------------------------------------------------------------------
    // Query helpers
    // -------------------------------------------------------------------------

    public function getSkillsByCategory(string $category): array
    {
        return $this->where('category', $category)->findAll();
    }

    public function searchSkills(string $keyword): array
    {
        return $this->groupStart()
            ->like('skill_name', $keyword)
            ->orLike('category', $keyword)
            ->orLike('description', $keyword)
            ->groupEnd()
            ->findAll();
    }

    /**
     * Get a skill with description converted to HTML line breaks,
     * and comma-separated fields expanded into arrays.
     *
     * NOTE: This presentation logic is better handled in the view,
     * but kept here for backward compatibility.
     */
    public function getSkillById(int|string $id): array|null
    {
        $skill = $this->find($id);

        if (! $skill) {
            return null;
        }

        $skill['description'] = nl2br((string) ($skill['description'] ?? ''));
        $skill['category']    = array_map('trim', explode(',', $skill['category'] ?? ''));
        $skill['skill_name']  = array_map('trim', explode(',', $skill['skill_name'] ?? ''));

        return $skill;
    }
}
