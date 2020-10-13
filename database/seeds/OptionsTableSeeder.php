<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('options')->insert([
			'published' => 1
		]);
		Db::table('option_slugs')->insert([
			'option_id' => 1,
			'slug' => 'altalanos',
			'locale' => 'hu',
			'active' => 1
		]);

		Db::table('option_translations')->insert([
			'option_id' => 1,
			'title' => 'Általános',
			'locale' => 'hu',
			'active' => 1
		]);
	}
}
