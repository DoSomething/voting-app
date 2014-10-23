<?php

class CandidatesTableSeeder extends Seeder {

	public function run()
	{
		Candidate::truncate();

		Candidate::create([
			'name' => 'Taylor Ottwell',
			'slug' => 'taylor-ottwell',
			'description' => 'Taylor made it all happen.',
		]);

		Candidate::create([
			'name' => 'Jeffrey Way',
			'slug' => 'jeffrey-way',
			'description' => 'Tuts, tuts, tuts.',
		]);

		Candidate::create([
			'name' => 'Jenn Schiffer',
			'slug' => 'jenn-schiffer',
			'description' => 'California Style Sheets.',
		]);

	}
}
