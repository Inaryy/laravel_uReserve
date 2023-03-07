<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $dummyDate = $this->faker->dateTimeThisMonth;
        return [
            'name' => $this->faker->name,
            'information' => $this->faker->realText,
            'max-people' => $this->faker->numberBetween(1, 20),
            'start-date' => $dummyDate->format('Y-m-d H:i:s'),
            'end-date' => $dummyDate->modify('+1hour')->format('Y-m-d H:i:s'),
            'is-visible' => $this->faker->boolean
        ];
    }
}
