<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1, 5) as $index){
            $category = $faker->unique()->name;
            Category::create([
                "name" => $category,
                "slug" => $this->slugify($category),
                "status" => rand(0, 1)
            ]);
        }
    }

    public function slugify($text)
    {
        //replace non later of digit
        $text = preg_replace('/[^\p{L}\p{N} ]+/', '', $text);

        //transliterate
        $text = iconv('utf-8', 'ascii//TRANSLIT', $text);

        //remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        //trim
        $text = trim($text, '-');

        //remove duplicate
        $text = preg_replace('~-+~', '-', $text);

        //lowercase
        $text = strtolower($text);

        if(empty($text))
            return 'n-a';

        return $text;
    }
}
