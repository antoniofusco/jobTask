<?php

use Illuminate\Database\Seeder;
use App\Conversion;
use App\IntegerConversion;
use App\User;
class ConversionsTableSeeder extends Seeder
{
	 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the conversions table first
        Conversion::truncate();
		$faker = \Faker\Factory::create();
		
		// Create a back door to test api
        $password = Hash::make('apitest');
		// Create an user and retrieve the id to insert in conversion table
        $lastInsertUserId =User::create([
            'name' => 'AdministratorApi',
            'email' => 'adminapi@test.com',
            'password' => $password,
        ])->id;
		
		$interfaceConversion = new IntegerConversion();
		// Insert number from 3 to 34
		for($i=3;$i<=34;$i++){
			Conversion::create([
                'number' 	=> (int)$i,
                'roman' 	=> $interfaceConversion->toRomanNumerals($i),
                'user_id'   => $lastInsertUserId,
            ]);	
		}
    }
}
