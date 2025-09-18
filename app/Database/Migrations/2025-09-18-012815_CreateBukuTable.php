<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBukuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_buku'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pengarang'   => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'penerbit'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tahun_terbit'=> [
                'type'       => 'YEAR',
            ],
            'sampul'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_buku', true);
        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}
