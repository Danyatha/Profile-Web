<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'page_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
            ],
            'ip_hash' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'comment'    => 'SHA-256 hash dari IP (privasi pengunjung)',
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'referrer' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'device' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'comment'    => 'mobile / tablet / desktop / bot',
            ],
            'visited_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('visited_at');
        $this->forge->addKey('page_url');
        $this->forge->createTable('visits');
    }

    public function down()
    {
        $this->forge->dropTable('visits');
    }
}
