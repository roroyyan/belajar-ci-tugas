<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $builder = $this->db->table('diskon');

        $tanggalAwal = strtotime('2025-07-01');
        for ($i = 0; $i < 10; $i++) {
            $tanggal = date('Y-m-d', strtotime("+$i days", $tanggalAwal));

            $builder->insert([
                'tanggal'    => $tanggal,
                'nominal'    => rand(100000, 1000000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}