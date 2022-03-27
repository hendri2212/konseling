<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->id = '9c68d65f-ee23-4048-9c58-43cd8417e1d8';
        $role->role = 'admin';
        $role->description = 'Akses full terhadap fitur service';
        $role->save();

        $role = new Role;
        $role->id = '303b91e8-cb19-4b76-9c23-ec823c2b9ed2';
        $role->role = 'sekolah.starter';
        $role->description = 'Role ini untuk sekolah yang baru mendaftar dan belum berlangganan';
        $role->save();
    }
}
