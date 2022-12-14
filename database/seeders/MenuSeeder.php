<?php

namespace Database\Seeders;

use App\Models\Menu;
use Faker\Factory as Faker;
use FakerRestaurant\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\Factory;

class MenuSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run()
	{
		$faker = \Faker\Factory::create();
		$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

		for ($i = 1; $i <= 1; $i++) {
			DB::table('menus')->insert([
				'name' => $faker->foodName() . ' ' . $faker->sauceName(),
				'price' => 1000 * $faker->numberBetween(10, 200),
				'stock' => $faker->numberBetween(25, 50),
				'type' => 'food',
				'menu_photo_path' => 'images/' . 'food_img' . $i . '.png'
			]);
		}
		for ($i = 1; $i <= 1; $i++) {
			DB::table('menus')->insert([
				'name' => $faker->beverageName() . ' ' . $faker->fruitName(),
				'price' => 1000 * $faker->numberBetween(10, 200),
				'stock' => $faker->numberBetween(25, 50),
				'type' => 'beverage',
				'menu_photo_path' => 'images/' . 'beverage_img' . $i . '.png'
			]);
		}
	}
}
