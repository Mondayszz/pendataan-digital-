<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kk;
use App\Models\Penduduk;

class KkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample KK data - bisa digunakan untuk restore cepat
        // Uncomment dan edit sesuai data asli Anda
        
        /*
        $kk1 = Kk::create([
            'kepala_keluarga' => 'Akbar',
            'alamat' => 'Desa Kopandakan 1',
            'jaga' => '1',
        ]);

        Penduduk::create([
            'kk_id' => $kk1->id,
            'nama' => 'Akbar',
            'nik' => '1234567891123456',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2004-08-24',
            'status_keluarga' => 'Kepala Keluarga',
            'pekerjaan' => 'BUMN',
            'alamat' => 'Desa Kopandakan 1',
            'jaga' => '1',
        ]);

        // Tambahkan anggota lainnya...
        */
    }
}
