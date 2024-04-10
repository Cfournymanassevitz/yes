<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use Faker\Generator as Faker;

/**
 * Class OrderFactory
 *
 * This class is responsible for creating fake instances of the Order model for testing purposes.
 * It extends Laravel's Factory class.
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * This method returns an array of fake data that matches the Order model's attributes.
     * The 'command_number' attribute is a UUID.
     * The 'user_id' attribute is the ID of the first user in the database.
     * The 'created_at' and 'updated_at' attributes are dates between 2 years ago and now.
     *
     * @return array
     */
    public function definition(): array
    {
        $user = User::all()->first();

        return [

            'command_number' => $this->faker->uuid,
            'user_id' => $user->id, // Get the first user id (if any
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
