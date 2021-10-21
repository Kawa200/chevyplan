<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $FakeMoney = [50000, 75000, 100000];

        return [
            'plan_id' => Plan::all()->random()->id,
            'value' => rand(5, 10) * $FakeMoney[rand(0, 2)],
            'date' => now()
        ];
    }
}
