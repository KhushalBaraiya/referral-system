<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => User::ROLE_ADMIN]);
        Role::create(['name' => User::ROLE_USER]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
        ]);
        $admin->assignRole(User::ROLE_ADMIN);
        $root = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
        ]);
        $root->assignRole(User::ROLE_USER);

        // $parent = $root;

        // for ($i = 2; $i <= 10; $i++) {

        //     $user = User::create([
        //         'name' => 'User ' . chr(64 + $i), // B, C, D...
        //         'email' => 'user' . $i . '@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('123456'),
        //         'parent_id' => $parent->id,
        //     ]);

        //     $user->assignRole(User::ROLE_USER);

        //     $parent = $user;
        // }

        // // 👥 CREATE 20 RANDOM USERS (REAL TREE)
        // $users = [$root]; // start from root

        // for ($i = 1; $i <= 20; $i++) {

        //     // random parent from existing users
        //     $randomParent = $users[array_rand($users)];

        //     $user = User::create([
        //         'name' => fake()->name(),
        //         'email' => 'demo' . $i . '@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('123456'),
        //         'parent_id' => $randomParent->id,
        //     ]);

        //     $user->assignRole(User::ROLE_USER);

        //     $users[] = $user; // add for future tree
        // }
    }
}
