<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        // Seed arsip table
        $arsipData = [
            ['nama_box' => 'Arsip Keuangan 2023'],
            ['nama_box' => 'Arsip Personalia 2023'],
            ['nama_box' => 'Arsip Proyek A'],
            ['nama_box' => 'Arsip Kontrak'],
            ['nama_box' => 'Arsip Umum']
        ];
        $this->db->table('arsip')->insertBatch($arsipData);

        // Seed pengguna table
        $penggunaData = [
            [
                'username' => 'admin',
                'password' => password_hash('1', PASSWORD_DEFAULT),
                'role' => 'admin',
                'nama_lengkap' => 'Admin Sistem',
                'izin_akses' => 'admin'
            ],
            [
                'username' => 'pegawai',
                'password' => password_hash('1', PASSWORD_DEFAULT),
                'role' => 'pegawai',
                'nama_lengkap' => 'Budi Santoso',
                'izin_akses' => 'pegawai'
            ]
        ];
        $this->db->table('pengguna')->insertBatch($penggunaData);

        // Seed suratkeluar table
        $suratKeluarData = [];
        for ($i = 1; $i <= 10; $i++) {
            $suratKeluarData[] = [
                'nomor_surat' => 'SK-00' . $i . '/VII/2023',
                'tanggal_surat' => $faker->date(),
                'tujuan' => $faker->company,
                'perihal' => $faker->sentence(6),
                'lampiran' => $i % 3 == 0 ? 'lampiran.pdf' : null
            ];
        }
        $this->db->table('suratkeluar')->insertBatch($suratKeluarData);

        // Seed suratmasuk table
        $suratMasukData = [];
        for ($i = 1; $i <= 10; $i++) {
            $suratMasukData[] = [
                'no_surat' => 'SM-00' . $i . '/VII/2023',
                'tgl_surat' => $faker->date(),
                'pengirim' => $faker->company,
                'perihal' => $faker->sentence(6),
                'file_lampiran' => $i % 4 == 0 ? 'dokumen.pdf' : null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->db->table('suratmasuk')->insertBatch($suratMasukData);

        // Seed lokasi table
        $lokasiData = [];
        for ($i = 1; $i <= 10; $i++) {
            $isSuratKeluar = $i % 2 == 0;
            $lokasiData[] = [
                'idsuratkeluar' => $isSuratKeluar ? $i : null,
                'idsuratmasuk' => $isSuratKeluar ? null : $i,
                'idarsip' => $faker->numberBetween(1, 5),
                'nomor_rak' => $faker->numberBetween(1, 10)
            ];
        }
        $this->db->table('lokasi')->insertBatch($lokasiData);
    }
}
