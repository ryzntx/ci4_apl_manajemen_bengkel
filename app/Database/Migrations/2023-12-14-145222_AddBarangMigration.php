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
            'nama' => [
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
            'id_supplier' => [
                'type'          => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'id_kategori_barang' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned' => true
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp null default current_timestamp'
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode_barang');
        $this->forge->addForeignKey('id_kategori_barang', 'kategori_barang', 'id');
        $this->forge->addForeignKey('id_supplier', 'supplier', 'id');
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
