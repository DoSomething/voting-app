<?php

use VotingApp\Models\Candidate;
use VotingApp\Models\Category;

class ContentTest extends TestCase
{

    /**
     * Verify that the homepage loads correctly.
     * @test
     */
    public function testHomepage()
    {
        $this->visit('/');

        // Check that the tagline is visible
        $this->see('Vote for the cutest kitten of the year. Vote once per day, and choose wisely!');
    }

    /**
     * Verify that the category detail page loads correctly.
     * @test
     */
    public function testViewCategory()
    {
        $category = Category::all()->first();

        $this->visit(route('categories.show', [$category->slug]))
             ->andSee($category->name);
    }

    /**
     * Verify that the candidate detail page loads correctly.
     * @test
     */
    public function testViewCandidate()
    {
        $candidate = Candidate::all()->first();

        $this->visit(route('candidates.show', [$candidate->slug]))
             ->andSee($candidate->name);
    }

    /**
     * Verify that the page resource loads correctly.
     * @test
     */
    public function testViewFaqPage()
    {
        $this->visit('/pages/faq')
            ->andSee('What is Lorem Ipsum?');
    }


}
