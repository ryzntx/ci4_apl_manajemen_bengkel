<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKategoriBarangMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'kategori_barang' => [
                'type' => "varchar",
                'constraint' => 120
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp null default current_timestamp'
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kategori_barang');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_barang');
    }
}
