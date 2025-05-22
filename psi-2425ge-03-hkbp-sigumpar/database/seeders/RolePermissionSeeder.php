<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Cek apakah user admin sudah ada berdasarkan email
        $userOwner = User::where('email', 'admin@gmail.com')->first();

        if (!$userOwner) {
            $userOwner = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123123123'),
            ]);
        }

        // Assign role admin ke user admin jika belum punya
        if (!$userOwner->hasRole('admin')) {
            $userOwner->assignRole($adminRole);
        }
    }
}
