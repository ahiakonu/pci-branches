<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        \App\Models\User::create([
            'name' => 'Wilson Ahiakonu',
            'email' => 'wilson@admin.com',
            'password' => bcrypt('wilson@1'),
            'user_role' => 'SYS_ADMIN',
            'user_role_id' => '1',
            'user_status' => 'Active'
        ]);

      /*   \App\Models\Division::create([
            'division_name' => 'GREATER ACCRA DIVISION 1',
            'country' => 'GHANA',
            'divisional_leader' => 'BISHP SELAISE AGYINASARE',
        ]);
        \App\Models\Division::create([
            'division_name' => 'GREATER ACCRA DIVISION 2',
            'country' => 'GHANA',
            'divisional_leader' => 'Bishop Raymond Kumah Acquah',
        ]);

        \App\Models\Zone::create([
            'division_name' => 'GREATER ACCRA DIVISION 2',
            'country' => 'GHANA',
            'divisional_leader' => 'Bishop Raymond Kumah Acquah',
        ]);

        \App\Models\Zone::create([
            'division_name' => 'GREATER ACCRA DIVISION 2',
            'country' => 'GHANA',
            'divisional_leader' => 'Bishop Raymond Kumah Acquah',
        ]);



        \App\Models\Branch::create([
            'church_name' => 'Perez Dome',
            'church_location' => 'Dzorwulu',
            'church_email' => 'perezdome@perezchapel.org',
            'division_id' => 'DV101',
            'zone_id' => 'ZN102',
            'city' => 'Greater Accra',
            'year_established' => '2004',
            'website' => 'www.perezdome.perezchapel.org',
            'church_status' => 'ACTIVE',
            'g_lat' => 'NA',
            'g_long' => 'NA'
        ]);
        \App\Models\Branch::create([
            'church_name' => 'Zoe Land ',
            'church_location' => 'mataheko',
            'church_email' => 'zoeland@perezchapel.org',
            'division_id' => 'DV101',
            'zone_id' => 'ZN102',
            'city' => 'Greater Accra',
            'year_established' => '2010',
            'website' => 'www.zoeland.perezchapel.org',
            'church_status' => 'INACTIVE',
            'g_lat' => 'NA',
            'g_long' => 'NA'
        ]); */

        ////
    }
}
