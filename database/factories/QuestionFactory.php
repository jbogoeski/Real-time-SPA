<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
            'body' => $this->faker->text,
            'category_id' => function() {
                return Category::all()->random();
            },
            'user_id' => function() {
                return User::all()->random();
            },
            
            
        ];
    }
}
