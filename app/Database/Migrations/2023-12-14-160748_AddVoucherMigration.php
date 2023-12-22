<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVoucherMigration extends Migration
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
            'kode_voucher' => [
                'type' => 'varchar',
                'constraint' => '20',
            ],
            'potongan' => [
                'type' => 'decimal',
                'constraint' => '10',
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
