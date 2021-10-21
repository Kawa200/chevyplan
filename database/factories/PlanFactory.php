<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::all()->random()->id,
            'plan_num' => rand(10000000, 99999999),
            'full_cost' => rand(25, 280) * 1000000,
            'payments_num' => $this->faker->randomElement([ '12', '24', '36', '48', '60', '72' ]),
            'start_date' => Carbon::today()->subDays(rand(0, 365))
        ];
    }
}
