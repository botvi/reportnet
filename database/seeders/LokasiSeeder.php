<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lokasi::create([
            "name" => "Carano",
            "latitude" => "-0.5195267463898653",
            "longitude" => "101.53321476832303",
            "ip_instansi" => "1.1.1.1",
            "icon_path" => "icon-map/tDPJgowno4sp6TqRd9ZLcuobE0OnFHcsVSbdp89E.jpg",
            "polygon_color" => "#ff0000",
        ]);
    }
}
