<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('administrator');

        $user = User::create([
            'name' => 'Sitt Aung',
            'email' => 'sittaung@example.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('project manager');

        $faker = Faker::create();

        foreach (range(1, 100) as $index)
        {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('member');
        }

    }
}
