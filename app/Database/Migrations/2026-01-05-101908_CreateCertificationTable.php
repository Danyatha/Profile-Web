<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCertificationsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'issuer' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'issue_year' => [
                'type' => 'YEAR',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'images_path' => [
                'type' => 'JSON',
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
        $this->forge->addKey('issue_year');          // handy for year-filter queries
        $this->forge->createTable('certifications');
    }

    public function down(): void
    {
        $this->forge->dropTable('certifications');
    }
}