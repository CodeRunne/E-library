<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Librarian',
            'email' => 'librarian@admin.com',
            'password' => \Hash::make('admin')
        ]);

        $librarian = Role::create(['name' => 'Librarian']);
        $user->assignRole($librarian);
    }
}