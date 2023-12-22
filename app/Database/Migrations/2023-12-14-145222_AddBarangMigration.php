<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBarangMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kode_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
            ],
            'nama_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ],
            'merek_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ],
            'jumlah_stok' => [
                'type'          => 'INT',
                'constraint'    => '11',
            ],
            'harga_beli' => [
                'type'          => 'INT',
                'constraint'    => '11',
            ],
            'harga_jual' => [
                'type'          => 'INT',
                'constraint'    => '11',
            ],
            'kode_supplier' => [
                'type'          => 'VARCHAR',
                'constraint'    => '45',
            ],
            'id_kategori_barang' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode_barang');
        $this->forge->addForeignKey('id_kategori_barang', 'kategori_barang', 'id');
        $this->forge->addForeignKey('kode_supplier', 'supplier', 'kode_supplier');
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
