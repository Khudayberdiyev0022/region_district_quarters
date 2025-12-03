<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\District;
use App\Models\Quarter;

class RegionSeeder extends Seeder
{
  public function run(): void
  {
    $regionsPath   = storage_path('data/json/regions.json');
    $districtsPath = storage_path('data/json/districts.json');
    $quartersPath  = storage_path('data/json/quarters.json');

    if (!file_exists($regionsPath)) {
      throw new \Exception("regions.json topilmadi");
    }
    if (!file_exists($districtsPath)) {
      throw new \Exception("districts.json topilmadi");
    }
    if (!file_exists($quartersPath)) {
      throw new \Exception("quarters.json topilmadi");
    }

    $regions   = json_decode(file_get_contents($regionsPath), true);
    $districts = json_decode(file_get_contents($districtsPath), true);
    $quarters  = json_decode(file_get_contents($quartersPath), true);

    foreach ($regions as $region) {
      Region::create([
        'id'       => $region['id'],
        'soato_id' => $region['soato_id'],
        'name_uz'  => $region['name_uz'],
        'name_oz'  => $region['name_oz'],
        'name_ru'  => $region['name_ru'],
      ]);
    }

    foreach ($districts as $district) {
      District::create([
        'id'        => $district['id'],
        'region_id' => $district['region_id'],
        'soato_id'  => $district['soato_id'],
        'name_uz'   => $district['name_uz'],
        'name_oz'   => $district['name_oz'],
        'name_ru'   => $district['name_ru'],
      ]);
    }

    foreach ($quarters as $quarter) {
      Quarter::create([
        'id'          => $quarter['id'],
        'district_id' => $quarter['district_id'],
        'soato_id'    => $quarter['soato_id'],
        'name_uz'     => $quarter['name_uz'],
        'name_oz'     => $quarter['name_oz'],
        'name_ru'     => $quarter['name_ru'],
      ]);
    }
  }
}
