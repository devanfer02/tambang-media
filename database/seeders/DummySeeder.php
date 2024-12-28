<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Approval;
use App\Models\Reservation;
use App\Models\VehicleFuelConsumption;
use App\Models\VehicleService;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::factory(200)->create();

        VehicleService::factory(10)->create();

        Approval::factory(400)->create();

        VehicleFuelConsumption::factory(50)->create();
    }
}
