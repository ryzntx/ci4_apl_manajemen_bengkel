<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdentitasMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'type' => [
                'type' => 'varchar',
                'constraint' => '120'
            ],
            'data' => [
                'type' => 'json',
                'null' => true
                // 'constraint' => '10'
            ],
            'visibility' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'default' => 1
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('identitas');
    }

    public function down()
    {
        $this->forge->dropTable('identitas');
    }
}
