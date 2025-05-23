<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create Car Type

        // CarType::factory()->sequence([
        //     ['name'=>'Sedan'],
        //     ['name'=>'Hatchback'],
        //     ['name'=>'SUV'],
        //     ['name'=>'Pickup Truck'],
        //     ['name'=>'Minivan'],
        //     ['name'=>'Jeep'],
        //     ['name'=>'Coupe'],
        //     ['name'=>'Crossover'],
        //     ['name'=>'Sports Car'],
        // ])->count(9)
        // ->create();

        $carTypes = ['Sedan', 'Hatchback', 'SUV', 'Pickup Truck', 'Minivan', 'Jeep', 'Coupe', 'Crossover', 'Sports Car'];

        foreach ($carTypes as $type) {
            CarType::factory()->state(['name' => $type])->create();
        }



        // create Fuel Type
        // FuelType::factory()->sequence([
        //     ['name'=>'Gasoline'],
        //     ['name'=>'Diesel'],
        //     ['name'=>'Electric'],
        //     ['name'=>'Hybrid'],
        // ])->count(4)
        // ->create();

        $fuelTypes = ['Gasoline', 'Diesel', 'Electric', 'Hybrid'];

        foreach ($fuelTypes as $type) {
            FuelType::factory()->state(['name' => $type])->create();
        }


        // create states
        $states = [
            'California' => ['Los Angeles', 'San Francisco', 'San Diego', 'San Jose'],
            'Texas' => ['Houston', 'San Antonio', 'Dallas', 'Austin', 'Fort Worth'],
            'Florida' => ['Miami', 'Orlando', 'Tampa', 'Jacksonville', 'St. Petersburg'],
            'New York' => ['New York City', 'Buffalo', 'Rochester', 'Yonkers', 'Syracuse'],
            'Illinois' => ['Chicago', 'Aurora', 'Naperville', 'Joliet', 'Rockford'],
            'Pennsylvania' => ['Philadelphia', 'Pittsburgh', 'Allentown', 'Erie', 'Reading'],
            'Ohio' => ['Columbus', 'Cleveland', 'Cincinnati', 'Toledo', 'Akron'],
            'Georgia' => ['Atlanta', 'Augusta', 'Columbus', 'Savannah', 'Athens'],
            'North Carolina' => ['Charlotte', 'Raleigh', 'Greensboro', 'Durham', 'Winston-Salem'],
            'Michigan' => ['Detroit', 'Grand Rapids', 'Warren', 'Sterling Heights', 'Ann Arbor'],
        ];

        // foreach ($states as $state => $cities) {
        // State::factory()
        // ->state(['name' => $state])
        // ->has(
        //     City::factory()
        //     ->count (count($cities))
        //     ->sequence(array_map(fn($city) => ['name' => $city], $cities))
        // )->create();
        // }
        foreach ($states as $state => $cities) {
        State::factory()
        ->state(['name' => $state])
        ->has(
            City::factory()
            ->sequence(...array_map(fn($city) => ['name' => $city], $cities))
        )->create();
        }

        
        //Create makers with their corresponding models
        $makers = [
            'Toyota' => ['Camry', 'Corolla', 'Highlander', 'RAV4', 'Prius'],
            'Ford' => ['F-150', 'Escape', 'Explorer', 'Mustang', 'Fusion'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Odyssey', 'HR-V'],
            'Chevrolet' => ['Silverado', 'Equinox', 'Malibu', 'Impala', 'Cruze'],
            'Nissan' => ['Altima', 'Sentra', 'Rogue', 'Maxima', 'Murano', 'Pathfinder'],
            'Lexus' => ['RX400', 'RX450', 'RX350', 'ES350', 'LS500', 'IS300'],
        ];

        foreach ($makers as $maker => $models) {
            Maker::factory()
            ->state(['name' => $maker])
            ->has(
                Model::factory()
                ->count (count($models))
                ->sequence(...array_map(fn($model) => ['name' => $model], $models))
            )->create();
        }

        // create 5 users
        User::factory()->count(3)->create();

        User::factory()
        ->count(2)
        ->has(
            Car::factory()
            ->count(50)
            ->has(
                CarImage::factory()
                ->count(5)
                ->sequence(fn(Sequence $sequence)=>
                ['position'=>$sequence->index+1]
            ),
            'images'
            )->hasFeatures()
            ,'favouriteCars'
        )->create();

    }
}
