<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->make([
            'name' => 'Sibongiseni',
            'surname' => 'Msomi',
            'is_admin' => true,
            'language_id' => Language::where('name', 'English')->pluck('id')->first(),
            'password'=> bcrypt('!Admin321'),
            'email' => 'sibongiseni.msomi@outlook.com',
        ])->save();

        User::factory()->make([
            'name' => 'Carmen',
            'surname' => 'Schafer',
            'is_admin' => true,
            'language_id' => Language::where('name', 'Afrikaans')->pluck('id')->first(),
            'password'=> bcrypt('!Admin321'),
            'email' => 'demo@demo.test'
        ])->save();
    }
}
