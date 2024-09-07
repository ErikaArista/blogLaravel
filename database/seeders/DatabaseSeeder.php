<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         //Eliminar carpetas
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');

         //Crear carpeta
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');

        //llamar seeder
        $this->call(UserSeeder::class);

        //llamar a factory
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();

    }
}
