<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJournalsTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'unique'     => true,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'default'    => null,
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'cover_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'is_published' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1 = published, 0 = draft',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
                'comment' => 'Soft delete',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('is_published');
        $this->forge->addKey('created_at');

        $this->forge->createTable('journals');
    }

    public function down()
    {
        $this->forge->dropTable('journals', true);
    }
}
