<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTransaksiMigration extends Migration
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
            'kode_transaksi' => [
                'type' => 'varchar',
                'constraint' => '20'
            ],
            'jenis_layanan' => [
                'type' => 'enum',
                'constraint' => ['Penjualan', 'Servis'],
            ],
            'total_dibayar' => [
                'type' => 'float',
            ],
            'total_uang' => [
                'type' => 'float',
            ],
            'status' => [
                'type' => 'enum',
                'constraint' => ['Belum Lunas', 'Lunas']
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp null default current_timestamp'
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode_transaksi');
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
