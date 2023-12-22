<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailTransaksiMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kode_transaksi' => [
                'type' => 'varchar',
                'constraint' => '20'
            ],
            'kode_barang' => [
                'type' => 'varchar',
                'constraint' => '20'
            ],
            'id_layanan_jasa' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'qty' => [
                'type' => 'int',
                'constraint' => '2'
            ],
            'total_harga' => [
                'type' => 'int',
                'constraint' => '11'
            ],
            'created_at'       => [
                'type' => 'timestamp',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]

        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kode_transaksi', 'transaksi', 'kode_transaksi');
        $this->forge->addForeignKey('kode_barang', 'barang', 'kode_barang');
        $this->forge->addForeignKey('id_layanan_jasa', 'layanan_jasa', 'id');
        $this->forge->createTable('detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaksi');
    }
}
