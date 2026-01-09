<?php

namespace App\Models;

use CodeIgniter\Model;

class SocialMediaModel extends Model
{
    protected $table = 'social_media';
    protected $primaryKey = 'id';
    protected $allowedFields = ['platform_name', 'profile_url', 'icon_class', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
}
