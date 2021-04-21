<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class stafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 10; $i++){
        DB::table('stafs')->insert([
            'id_staf' => $faker->unique()->numberBetween($min = 10000000, $max = 90000000),
            'jabatan' => 'Delivery',
            'nama' =>$faker->name,
            'email' => $faker->email,
            'phone' => $faker->e164PhoneNumber,
            'alamat' => $faker->address,
            'created_at' => $faker->dateTime($max = 'now')
        ]);
        }
    }
}
