<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaksi::create([
            'id_user' => '2',
            'jenis_transaksi' => '1',
            'nama_transaksi' => 'Pemasukan Dana',
            'jenis_transaksi' => 'Pemasukan',
            'nominal' => '2000000',
            'keterangan' => '-',
            'updated_at' => date('Y-m-d H:i:s', time()),
            'created_at' => date('Y-m-d H:i:s', time())
        //
        ]);
    }
}
