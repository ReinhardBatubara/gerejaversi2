<?php

namespace Database\Seeders;

use App\Models\ProfileGereja;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // run role
        $this->call(RolePermissionSeeder::class);
        $this->call(LayananGerejaSeeder::class);
        $this->call(LokasiGerejaSeeder::class);
        $this->call(ProfilePendetaSeeder::class);
        $this->call(ProfileGerejaSeeder::class);
    }
}
