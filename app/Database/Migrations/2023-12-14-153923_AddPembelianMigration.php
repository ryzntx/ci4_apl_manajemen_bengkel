<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPembelianMigration extends Migration
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
            'kode_pembelian' => [
                'type' => 'varchar',
                'constraint' => '120',
            ],
            'kode_supplier' => [
                'type' => 'varchar',
                'constraint' => '120',
            ],
            'jumlah_order' => [
                'type' => 'int',
                'constraint' => 11
            ],
            'total_harga' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'enum',
                "constraint" => ["Menunggu Persetujuan", "Disetujui", "Ditolak"],
                'default' => 'Menunggu Persetujuan'
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode_pembelian');
        $this->forge->addForeignKey('kode_supplier', 'supplier', 'kode_supplier');
        $this->forge->createTable('pembelian');
    }

    public function down()
    {
        $this->forge->dropTable('pembelian');
    }
}
