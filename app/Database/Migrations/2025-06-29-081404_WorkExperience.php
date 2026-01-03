<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WorkExperience extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'company_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'position' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'job_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'is_current' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'company_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'documentation_images' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'skills_used' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'achievements' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('start_date');
        $this->forge->createTable('work_experiences');
    }

    public function down()
    {
        $this->forge->dropTable('work_experiences');
    }
}
