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
        $avalableHour = $this->faker->numberBetween(10,12);
        $minutes = [0, 30];
        $mKey = array_rand($minutes);
        $addHOur = $this->faker->numberBetween(1, 3);


        $dummyDate = $this->faker->dateTimeThisMonth;
        $starDate = $dummyDate->setTime($avalableHour, $minutes[$mKey]);
        $clone = clone $starDate;
        $endDate = $clone->modify('+'.$addHOur.'hour');

        // dd($starDate);
        // dd($endDate);

        return [
            'name' => $this->faker->name,
            'information' => $this->faker->realText,
            'max_people' => $this->faker->numberBetween(1, 20),
            'start_date' => $starDate,
            'end_date' => $endDate,
            'is_visible' => $this->faker->boolean
        ];
    }
}
