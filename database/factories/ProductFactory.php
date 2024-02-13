<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('test_image.jpg');

        $path = $image->store('/');

        return [
            'name'        => fake()->word(),
            'description' => fake()->sentence(),
            'tags'        => 'a,b,c',
            'category_id' => Category::query()->inRandomOrder()->first(),
            'picture'     => $path
        ];
    }
}
