<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\User;
use App\Models\Unit;
use App\Models\GasPrice;
use App\Models\Route;
use App\Models\Road;
use App\Models\Toll;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gm.com',
            'password' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@gm.com',
            'password' => 'user'
        ]);

        Unit::factory()->create([
            'name' => 'Automovil',
            'passenger_capacity' => 4
        ]);
        Unit::factory()->create([
            'name' => 'Pick Up',
            'passenger_capacity' => 4
        ]);
        Unit::factory()->create([
            'name' => 'Motocicleta',
            'passenger_capacity' => 2
        ]);
        Unit::factory()->create([
            'name' => 'Autobus 2 Ejes',
            'passenger_capacity' => 40
        ]);
        Unit::factory()->create([
            'name' => 'Autobus 3 Ejes',
            'passenger_capacity' => 60
        ]);
        Unit::factory()->create([
            'name' => 'Autobus 4 Ejes',
            'passenger_capacity' => 80
        ]);
        Unit::factory()->create([
            'name' => 'Camion 2 Ejes',
            'passenger_capacity' => 3
        ]);
        Unit::factory()->create([
            'name' => 'Camion 3 Ejes',
            'passenger_capacity' => 2
        ]);
        Unit::factory()->create([
            'name' => 'Camion 4 Ejes',
            'passenger_capacity' => 3
        ]);
        Unit::factory()->create([
            'name' => 'Camion 5 Ejes',
            'passenger_capacity' => 3
        ]);
        Unit::factory()->create([
            'name' => 'Camion 6 Ejes',
            'passenger_capacity' => 3
        ]);
        Unit::factory()->create([
            'name' => 'Camion 7 Ejes',
            'passenger_capacity' => 3
        ]);
        Unit::factory()->create([
            'name' => 'Camion 8 Ejes',
            'passenger_capacity' => 3
        ]);
        Unit::factory()->create([
            'name' => 'Camion 9 Ejes',
            'passenger_capacity' => 3
        ]);

        Route::factory()->create([
            'name' => 'Mexical, Tecate Tijuana, Rosarito, Ensenada',
            'departure_distance' => 286.91,
            'return_distance' => 286.91,
        ]);
        Route::factory()->create([
            'name' => 'Mexical, Tecate',
            'departure_distance' => 129.75,
            'return_distance' => 129.75,
        ]);
        Route::factory()->create([
            'name' => 'Mexical, Tecate, Ensenada',
            'departure_distance' => 266.55,
            'return_distance' => 266.55,
        ]);
        Route::factory()->create([
            'name' => 'Mexical, Tijuana',
            'departure_distance' => 171.56,
            'return_distance' => 171.56,
        ]);

        GasPrice::factory()->create([
            'name' => 'Magna',
            'price' => 22.13,
        ]);
        GasPrice::factory()->create([
            'name' => 'Premium',
            'price' => 23.61,
        ]);
        GasPrice::factory()->create([
            'name' => 'Diesel',
            'price' => 23.90,
        ]);

        Toll::factory()->create([
            'name' => 'La Rumorosa',
        ]);
        Toll::factory()->create([
            'name' => 'El Hongo',
        ]);
        Toll::factory()->create([
            'name' => 'Tijuana',
        ]);
        Toll::factory()->create([
            'name' => 'Rosarito',
        ]);
        Toll::factory()->create([
            'name' => 'Ensenada',
        ]);

        Road::factory()->create([
            'name' => 'Mexicali - Flor Del Desierto'
        ]);
        Road::factory()->create([
            'name' => 'Flor Del Desierto - Entronque La Rumorosa',
            'toll_id' => 1,
        ]);
        Road::factory()->create([
            'name' => 'Entronque La Rumorosa - Libramiento de Tecate',
            'toll_id' => 2,
        ]);
        Road::factory()->create([
            'name' => 'Libramiento de Tecate - Ent. Tijuana',
            'toll_id' => 3,
        ]);
        Road::factory()->create([
            'name' => 'Entronque de Tijuana - Rosarito',
        ]);
        Road::factory()->create([
            'name' => 'Rosarito - Entronque Rosarito',
        ]);
        Road::factory()->create([
            'name' => 'Entronque Rosarito - Entronque La Mision',
            'toll_id' => 4,
        ]);
        Road::factory()->create([
            'name' => 'Entronque La Mision - San Miguel',
            'toll_id' => 5,
        ]);
        Road::factory()->create([
            'name' => 'San Miguel - Ensenada',
        ]);

        DB::table('road_route')->insert([
            [
                'route_id' => 1,
                'road_id' => 1,
                ],[
                'route_id' => 1,
                'road_id' => 2,
                ],[
                'route_id' => 1,
                'road_id' => 3,
                ],[
                'route_id' => 1,
                'road_id' => 4,
                ],[
                'route_id' => 1,
                'road_id' => 5,
                ],[
                'route_id' => 1,
                'road_id' => 6,
                ],[
                'route_id' => 1,
                'road_id' => 7,
                ],[
                'route_id' => 1,
                'road_id' => 8,
                ],[
                'route_id' => 1,
                'road_id' => 9,
                ],[
                'route_id' => 2,
                'road_id' => 1,
                ],[
                'route_id' => 3,
                'road_id' => 1,
                ],[
                'route_id' => 4,
                'road_id' => 1,
            ]
        ]);

        DB::table('unit_toll')->insert([
            [
                'unit_id' => 1,
                'toll_id' => 1,
                'price' => 30,
            ],[
                'unit_id' => 1,
                'toll_id' => 2,
                'price' => 97,
            ],[
                'unit_id' => 1,
                'toll_id' => 3,
                'price' => 151,
            ],[
                'unit_id' => 1,
                'toll_id' => 4,
                'price' => 44,
            ],[
                'unit_id' => 1,
                'toll_id' => 5,
                'price' => 48,
            ],
        ]);

        Budget::factory()->create([
            'user_id' => 1,
            'type' => 'oneway',
            'departure' => '2024-12-08 06:00:00',
            'passengers' => 4,
            'unit_id' => 1,
            'gas_price_id' => 1,
            'departure_route' => 1,
        ]);
    }
}
