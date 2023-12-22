<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailPembelianMigration extends Migration
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
            'kode_pembelian' => [
                'type' => 'varchar',
                'constraint' => '120',
            ],
            'id_barang' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'jumlah' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'total_harga' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => false,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kode_pembelian', 'pembelian', 'kode_pembelian');
        $this->forge->addForeignKey('id_barang', 'barang', 'id');
        $this->forge->createTable('detail_pembelian');
    }

    public function down()
    {
        $this->forge->dropTable('detail_pembelian');
    }
}
