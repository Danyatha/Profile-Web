<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run()
    {
        helper('text'); // untuk url_title

        $this->db->table('journals')->truncate();

        $data = [];

        $categories = ['Tech', 'Lifestyle', 'Education', 'Health'];

        for ($i = 1; $i <= 100; $i++) {
            $title = "Sample Journal Title $i";

            $data[] = [
                'title'         => $title,
                'slug'          => url_title($title, '-', true) . "-$i",
                'category'      => $categories[array_rand($categories)],
                'content'       => "Ini adalah isi konten untuk jurnal ke-$i. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                'cover_image'   => null,
                'is_published'  => rand(0, 1),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
                'deleted_at'    => null,
            ];
        }

        $this->db->table('journals')->insertBatch($data);
    }
}
