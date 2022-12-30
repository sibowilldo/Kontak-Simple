<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $interests =  Interest::get();
        User::factory(10)->hasAttached($interests->random(random_int(1,5)))->create();
    }
}
