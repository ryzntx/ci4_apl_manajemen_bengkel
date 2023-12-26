<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSupplierMigration extends Migration
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
            'kode_supplier' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ],
            'nama_supplier' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ],
            'alamat' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'no_telp' => [
                'type'          => 'VARCHAR',
                'constraint'    => '64',
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp null default current_timestamp'
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode_supplier');
        $this->forge->createTable('supplier');
    }

    public function down()
    {
        $this->forge->dropTable('supplier');
    }
}
