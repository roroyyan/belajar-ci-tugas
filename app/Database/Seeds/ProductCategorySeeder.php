<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Elektronik & Gadget',
                'description' => 'Berbagai perangkat elektronik terkini seperti smartphone, laptop, dan aksesori canggih yang mendukung aktivitas digital Anda.',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Fashion & Gaya Hidup',
                'description' => 'Pakaian dan aksesori yang sedang tren, mulai dari streetwear hingga busana formal yang menunjang kepercayaan diri Anda.',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Rumah & Dekorasi',
                'description' => 'Koleksi perlengkapan rumah, dekorasi, dan perabotan untuk menciptakan suasana nyaman dan estetis di hunian Anda.',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Olahraga & Outdoor',
                'description' => 'Perlengkapan olahraga dan kegiatan luar ruangan seperti sepeda, alat fitness, dan perlengkapan camping.',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Kuliner & Makanan',
                'description' => 'Aneka bahan makanan, minuman, dan camilan lezat yang siap menemani setiap momen spesial Anda.',
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            $this->db->table('product_category')->insert($item);
        }
    }
}