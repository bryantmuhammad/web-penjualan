<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create('id_ID');
        $user   = User::create([
            'name'              => $faker->name(),
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
        ]);
        $user->assignRole('admin');

        // $user = User::create([
        //     'name'              => $faker->name(),
        //     'email'             => 'superadmin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password'          => Hash::make('admin'),
        //     'remember_token'    => Str::random(10),
        // ]);
        // $user->assignRole('Super Admin');

        $user = User::create([
            'name'              => $faker->name(),
            'email'             => 'pemilik@gmail.com',
            'email_verified_at' => now(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
        ]);

        $user->assignRole('pemilik');

        $user = User::create([
            'name'              => $faker->name(),
            'email'             => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
        ]);

        $user->assignRole('customer');
    }
}
