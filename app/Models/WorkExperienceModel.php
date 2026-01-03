<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkExperienceModel extends Model
{
    protected $table = 'work_experiences';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;

    protected $allowedFields = [
        'company_name',
        'position',
        'description',
        'job_description',
        'start_date',
        'end_date',
        'is_current',
        'company_logo',
        'documentation_images',
        'skills_used',
        'achievements'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'company_name' => 'required|max_length[255]',
        'position' => 'required|max_length[255]',
        'start_date' => 'required|valid_date',
        'end_date' => 'permit_empty|valid_date',
        'description' => 'permit_empty|max_length[1000]',
        'job_description' => 'permit_empty',
        'achievements' => 'permit_empty'
    ];

    protected $validationMessages = [
        'company_name' => [
            'required' => 'Nama perusahaan harus diisi',
            'max_length' => 'Nama perusahaan maksimal 255 karakter'
        ],
        'position' => [
            'required' => 'Posisi harus diisi',
            'max_length' => 'Posisi maksimal 255 karakter'
        ],
        'start_date' => [
            'required' => 'Tanggal mulai harus diisi',
            'valid_date' => 'Format tanggal mulai tidak valid'
        ],
        'end_date' => [
            'valid_date' => 'Format tanggal selesai tidak valid'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        return $this->processJsonFields($data);
    }

    protected function beforeUpdate(array $data)
    {
        return $this->processJsonFields($data);
    }

    private function processJsonFields(array $data)
    {
        if (isset($data['data']['documentation_images']) && is_array($data['data']['documentation_images'])) {
            $data['data']['documentation_images'] = json_encode($data['data']['documentation_images']);
        }

        if (isset($data['data']['skills_used']) && is_array($data['data']['skills_used'])) {
            $data['data']['skills_used'] = json_encode($data['data']['skills_used']);
        }

        return $data;
    }

    public function getWorkExperiences($orderBy = 'start_date', $order = 'DESC')
    {
        $experiences = $this->orderBy($orderBy, $order)->findAll();

        foreach ($experiences as &$experience) {
            $experience['documentation_images'] = json_decode($experience['documentation_images'], true) ?? [];
            $experience['skills_used'] = json_decode($experience['skills_used'], true) ?? [];
            $experience['period'] = $this->calculatePeriod($experience['start_date'], $experience['end_date']);
        }

        return $experiences;
    }

    public function getWorkExperienceById($id)
    {
        $experience = $this->find($id);

        if ($experience) {
            $experience['documentation_images'] = json_decode($experience['documentation_images'], true) ?? [];
            $experience['skills_used'] = json_decode($experience['skills_used'], true) ?? [];
            $experience['period'] = $this->calculatePeriod($experience['start_date'], $experience['end_date']);
        }

        return $experience;
    }

    private function calculatePeriod($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = $endDate ? new \DateTime($endDate) : new \DateTime();

        $interval = $start->diff($end);

        $years = $interval->y;
        $months = $interval->m;

        $period = '';

        if ($years > 0) {
            $period .= $years . ' tahun';
        }

        if ($months > 0) {
            if ($period) $period .= ' ';
            $period .= $months . ' bulan';
        }

        if (!$period) {
            $period = '< 1 bulan';
        }

        return $period;
    }

    public function uploadFile($file, $path = 'uploads/work_experience/')
    {
        if (!$file->isValid()) {
            return false;
        }

        $newName = $file->getRandomName();

        if ($file->move($path, $newName)) {
            return $newName;
        }

        return false;
    }

    public function deleteFile($filename, $path = 'uploads/work_experience/')
    {
        $filePath = $path . $filename;

        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }
}
