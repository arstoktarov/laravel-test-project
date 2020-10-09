<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    const PRODUCT_SEED_COUNT = 5;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $this->createProducts($category->id, self::PRODUCT_SEED_COUNT);
        }
    }

    /**
     * Creates products filled randomly
     *
     * @param int $category_id
     * @param int $count
     */
    public function createProducts(int $category_id, int $count) {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            DB::table('products')->insert([
                'title' => "Product №$i",
                'category_id' => $category_id,
                'description' => $faker->text(100),
                'image' => $faker->imageUrl(),
                'price' => round(mt_rand(1000, 10000)),
            ]);
        }
    }
}
