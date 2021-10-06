<?php

namespace Database\Seeders;

use App\Models\Companies;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
