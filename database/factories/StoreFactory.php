<?php


namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * Class StoreFactory
 *
 * This class is responsible for creating fake instances of the Store model for testing purposes.
 * It extends Laravel's Factory class.
 */
/**
 * @property $uuid
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;
    protected $company;
    protected $paragraph;


    /**
     * Define the model's default state.
     *
     * This method returns an array of fake data that matches the Store model's attributes.
     * The 'user_id' attribute is a random user ID from the database.
     * The 'name' attribute is a fake company name.
     * The 'theme' attribute is a fake word.
     * The 'biography' attribute is a fake paragraph.
     *
     * @return array
     */
    public function definition() : array
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'name' => $this->faker->company,
            'theme' => $this->faker->word,
            'biography' => $this->faker->paragraph,
        ];
    }
}
