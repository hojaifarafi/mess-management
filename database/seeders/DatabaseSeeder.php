<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([[
            'name' => 'Fahim Faisal',
            'email' => 'fahimfaisal@gmail.com',
        ],[
            'name' => 'Sayid Ahmed',
            'email' => 'sayidahmed@gmail.com',
        ],[
            'name' => 'Md. Safiqul Islam Sabid ',
            'email' => 'sabid@gmail.com',
        ],[
            'name' => 'Sakib Ferdus',
            'email' => 'sakib@gmail.com'
        ],[
            'name' => 'Rushud Sakib',
            'email' => 'rushud@gmail.com'
        ],[
            'name' => 'Sezan Mahmud Tonmoy',
            'email' => 'sezan@gmail.com'
        ],[
            'name' => 'Srobon Mia',
            'email' => 'srobon@gmail.com'
        ],[
            'name' => 'Touhidur Rahman',
            'email' => 'touhidur@gmail.com'
        ]]);
    }
}
