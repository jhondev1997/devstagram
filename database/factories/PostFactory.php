<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */

  protected $model = Post::class;

  public function definition(): array
  {
    return [
      'titulo'=> $this->faker->sentence(5),
      'descripcion'=> $this->faker->sentence(20),
      'imagen'=>$this->faker->uuid() . '.jpg',
      'user_id'=> $this->faker->randomElement([1,2,3])
    ];
  }
}
