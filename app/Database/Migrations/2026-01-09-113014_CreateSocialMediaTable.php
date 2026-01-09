<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSocialMediaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'platform_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'profile_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'icon_class' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('social_media');
    }

    public function down()
    {
        $this->forge->dropTable('social_media');
    }
}
