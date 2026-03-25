<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();

        // Cek apakah user sudah ada
        $existing = $users->findByCredentials([
            'email' => 'admin@example.com'
        ]);

        if ($existing) {
            // kalau sudah ada, langsung assign group saja
            $existing->addGroup('admin');
            return;
        }

        $user = new User();

        $user->username = 'admin';
        $user->email    = 'admin@example.com';
        $user->password = 'admin123'; // penting: plain text, biar Shield hash
        $user->active   = 1;

        // Simpan (ini yang trigger identities)
        $users->save($user);

        // Ambil ulang entity (biar pasti sinkron)
        $user = $users->findById($users->getInsertID());

        if ($user) {
            $user->addGroup('admin');
        }
    }
}
