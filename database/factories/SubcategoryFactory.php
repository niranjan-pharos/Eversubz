<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => function () {
                return \App\Models\Category::factory()->create()->id;
            },
            'name' => $this->faker->word(),
            'slug' => Str::slug($this->faker->unique()->word()),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
