<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLayananJasaMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_layanan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '120',
            ],
            'harga' => [
                'type'          => 'INT',
                'constraint'    => '11',
            ],
            'deskripsi' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp null default current_timestamp'
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('layanan_servis');
    }

    public function down()
    {
        $this->forge->dropTable('layanan_servis');
    }
}
