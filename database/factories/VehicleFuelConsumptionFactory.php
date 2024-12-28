<?php

namespace Database\Factories;

use App\Models\VehicleFuelConsumption;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFuelConsumptionFactory extends Factory
{
    protected $model = VehicleFuelConsumption::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory(),
            'fuel_type' => fake()->randomElement(['Diesel','Petrol','Gasoline']),
            'fuel_liters' => $this->faker->randomFloat(2, 10, 100),
            'fuel_date' => $this->faker->date()
        ];
    }
}
