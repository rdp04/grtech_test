<?php

namespace Database\Seeders;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@grtech.com.my',
            'password' => bcrypt('password')
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@grtech.com.my',
            'password' => bcrypt('password')
        ]);

        Companies::create([
            'name' => 'Mark Zuckenberg',
            'email' => 'admin@grtech.com.my',
            'website' => 'https://www.facebook.com/'
        ]);

        Companies::create([
            'name' => 'Kevin Systrom',
            'email' => 'admin@grtech.com.my',
            'website' => 'https://www.instagram.com/'
        ]);

        // Companies::factory(5)->create();

        Employees::factory(20)->create();
    }
}
