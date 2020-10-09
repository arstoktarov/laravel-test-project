<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    const CATEGORY_SEED_COUNT = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategories(self::CATEGORY_SEED_COUNT);
    }

    public function createCategories($count) {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            DB::table('categories')->insert([
                'title' => "Category №$i",
                'image' => $faker->imageUrl()
            ]);
        }
    }
}
