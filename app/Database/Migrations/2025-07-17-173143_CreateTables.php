<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Create arsip table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_box' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('arsip');

        // Create pengguna table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'izin_akses' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'pegawai'],
                'default' => 'pegawai'
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pengguna');

        // Create suratkeluar table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nomor_surat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tanggal_surat' => [
                'type' => 'DATE',
                'null' => false
            ],
            'tujuan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'perihal' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'lampiran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('suratkeluar');

        // Create suratmasuk table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'no_surat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'tgl_surat' => [
                'type' => 'DATE',
                'null' => false
            ],
            'pengirim' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'perihal' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'file_lampiran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('suratmasuk');

        // Create lokasi table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'idsuratkeluar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'idsuratmasuk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'idarsip' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'nomor_rak' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('idsuratkeluar', 'suratkeluar', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('idsuratmasuk', 'suratmasuk', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('idarsip', 'arsip', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('lokasi');
    }

    public function down()
    {
        $this->forge->dropTable('lokasi', true);
        $this->forge->dropTable('suratmasuk', true);
        $this->forge->dropTable('suratkeluar', true);
        $this->forge->dropTable('pengguna', true);
        $this->forge->dropTable('arsip', true);
    }
}
