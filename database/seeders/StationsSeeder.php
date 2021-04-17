<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations_list = ['New Valley', 'Matruh', 'Red Sea', 'Giza', 'South Sinai', 'North Sinai', 'Suez', 'Beheira', 'Helwan', 'Sharqia', 'Dakahlia', 'Kafr el-Sheikh', 'Alexandria', 'Monufia', 'Minya', 'Gharbia', 'Faiyum', 'Qena', 'Asyut', 'Sohag', 'Ismailia', 'Beni Suef', 'Qalyubia', 'Aswan', 'Damietta', 'Cairo', 'Port Said', 'Luxor', '6th of October'];
        foreach ($stations_list as $key => $station_name) {
            $station = new Station();
            $station->name = $station_name;
            $station->save();
        }
    }
}
