<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomerMigration extends Migration
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
            'kode_transaksi' => [
                'type' => 'varchar',
                'constraint' => '20'
            ],
            'no_plat' => [
                'type' => 'varchar',
                'constraint' => '10'
            ],
            'model_kendaraan' => [
                'type' => 'varchar',
                'constraint' => '120'
            ],
            'nama_pemilik' => [
                'type' => 'varchar',
                'constraint' => '120',
                'null' => true,
            ],
            'no_telp' => [
                'type' => 'varchar',
                'constraint' => '15',
                'null' => true,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp null default current_timestamp'
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kode_transaksi', 'transaksi', 'kode_transaksi');
        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}
