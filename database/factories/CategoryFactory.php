<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word(10);

        $directory = public_path('storage/categories');
    
        // Verifica si el directorio existe; si no, créalo
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Genera la imagen en el directorio especificado
        $imagePath = $this->faker->image($directory, 640, 480, null, false);
        
        return [

            'name' => $name,
            'slug' => Str::slug($name),
            //si no lee este direccion del directorio primero hay que colocar las lineas de codigo en DatabaseSeeder
            //'image' => 'categories/'. $this->faker->image('public/storage/categories', 640, 480, null, false),
            'image' => 'categories/' . $imagePath,
            'is_featured' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
        ];
    }
}
