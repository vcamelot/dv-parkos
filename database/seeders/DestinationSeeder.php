<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinations')->insert([
            'name' => 'Arrivals Parking Lot',
            'location' => 'Airport',
            'capacity' => 100
        ]);
        DB::table('destinations')->insert([
            'name' => 'Departures Parking Lot',
            'location' => 'Airport',
            'capacity' => 150
        ]);
        DB::table('destinations')->insert([
            'name' => 'Underground Parking Lot',
            'location' => 'Main railway station',
            'capacity' => 80
        ]);
    }
}
