<?php

namespace App\Models;

use CodeIgniter\Model;

class JournalModel extends Model
{
    protected $table            = 'journals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'title', 'slug', 'category', 'content', 'cover_image',
        'document_file', 'document_name', 'document_type',
        'is_published',
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title'   => 'required|min_length[3]|max_length[255]',
        'content' => 'required|min_length[10]',
        'slug'    => 'required|max_length[255]|is_unique[journals.slug,id,{id}]',
    ];

    protected $validationMessages = [
        'title' => [
            'required'   => 'Title wajib diisi.',
            'min_length' => 'Title minimal 3 karakter.',
        ],
        'content' => [
            'required'   => 'Konten wajib diisi.',
            'min_length' => 'Konten minimal 10 karakter.',
        ],
        'slug' => [
            'is_unique' => 'Slug sudah digunakan, coba judul lain.',
        ],
    ];

    protected $skipValidation = false;

    // ----------------------------------------------------------------
    // Custom Methods
    // ----------------------------------------------------------------

    /**
     * Ambil semua jurnal yang sudah dipublish, urutkan terbaru.
     */
    public function getPublished(int $limit = 10, int $offset = 0): array
    {
        return $this->where('is_published', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll($limit, $offset);
    }

    /**
     * Ambil jurnal berdasarkan slug (untuk halaman detail).
     */
    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)
            ->where('is_published', 1)
            ->first();
    }

    /**
     * Ambil jurnal berdasarkan kategori.
     */
    public function getByCategory(string $category, int $limit = 10): array
    {
        return $this->where('category', $category)
            ->where('is_published', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    /**
     * Hitung total jurnal yang published (untuk pagination).
     */
    public function countPublished(): int
    {
        return $this->where('is_published', 1)->countAllResults();
    }

    /**
     * Generate slug unik dari judul.
     * Dipanggil sebelum insert/update.
     */
    public function makeSlug(string $title, int $excludeId = 0): string
    {
        // Ubah jadi lowercase, ganti spasi dengan dash, hapus karakter non-alphanumeric
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

        $originalSlug = $slug;
        $counter      = 1;

        // Cek apakah slug sudah ada
        while (true) {
            $builder = $this->where('slug', $slug);
            if ($excludeId > 0) {
                $builder = $builder->where('id !=', $excludeId);
            }
            $exists = $builder->withDeleted()->first();

            if (!$exists) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Ambil daftar kategori yang tersedia (distinct).
     */
    public function getCategories(): array
    {
        return $this->select('category')
            ->where('is_published', 1)
            ->where('category IS NOT NULL', null, false)
            ->groupBy('category')
            ->orderBy('category', 'ASC')
            ->findAll();
    }
}
