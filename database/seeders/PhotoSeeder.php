<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $category_ids = Category::pluck('id')->all();

        for ($i = 0; $i < 5; $i++) {
            $photo = new Photo();
            $photo->category_id = $faker->randomElement($category_ids);
            $photo->title = $faker->words(4, true);
            $photo->description = $faker->paragraph(1, true);
            $photo->image = $faker->imageUrl(640, 400, 'photos', true, $photo->name, 'jpg');
            $photo->evidence_id = $faker->boolean();
            $photo->save();
        }
    }
}
