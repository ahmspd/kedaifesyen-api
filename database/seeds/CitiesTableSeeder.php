<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $url_city = "https://api.rajaongkir.com/starter/city?key=2e4e75e584741ebaba2b396816dcfc09";     
        $json_str = file_get_contents($url_city);     
        $json_obj = json_decode($json_str);     
        $cities = [];     
        foreach($json_obj->rajaongkir->results as $city){         
        	$cities[] = [             
         		'id' => $city->city_id,             
         		'province_id' => $city->province_id,             
         		'city' => $city->city_name,             
         		'type' => $city->type,             
         		'postal_code' => $city->postal_code,         
         	];     
        }     
        DB::table('cities')->insert($cities); 
    }
}
