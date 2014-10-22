<?php

class CandidatesTableSeeder extends Seeder {

	public function run()
	{
		Candidate::truncate();

		Candidate::create([
			'name' => 'Taylor Ottwell',
			'slug' => 'taylor-ottwell',
			'description' => 'Taylor made it all happen.',
			'category_id' => 1,
		]);

		Candidate::create([
			'name' => 'Jeffrey Way',
			'slug' => 'jeffrey-way',
			'description' => 'Tuts, tuts, tuts.',
			'category_id' => 1,
		]);

		Candidate::create([
			'name' => 'Jenn Schiffer',
			'slug' => 'jenn-schiffer',
			'description' => 'California Style Sheets.',
			'category_id' => 2,
		]);

	}
}
