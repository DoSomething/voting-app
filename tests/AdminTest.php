<?php

use VotingApp\Models\User;
use VotingApp\Models\Page;

class AdminTest extends TestCase
{
    protected $adminUser;
    protected $normalUser;

    /**
     * Prepare admin & authenticated users.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->adminUser = User::create([
            'first_name' => 'Puppet',
            'email' => 'sloth@dosomething.org',
            'password' => 'testing123',
        ]);
        $this->adminUser->admin = true;
        $this->adminUser->save();

        $this->normalUser = User::create([
            'first_name' => 'Sloth',
            'email' => 'testuser@dosomething.org',
            'password' => 'testing123',
        ]);
    }

    /**
     * Verify the 'create candidate' form functions properly.
     * @test
     */
    public function testCreateCandidate()
    {
        $this->visit(route('candidates.create'))
             ->seePageIs('/admin');

        // Normal users should not be able to create candidates
        $this->be($this->normalUser);
        $this->visit(route('candidates.create'))->seePageIs('/');

        // Admin users should see the admin form
        $this->be($this->adminUser);
        $this->visit(route('candidates.create'))
             ->see('Create Candidate');
    }

    /**
     * Verify that pages can be created.
     */
    public function testPageCreate()
    {
        $this->be($this->adminUser);

        // Check that creating a page is successful
        $this->visit(route('pages.create'))
            ->type('Test Page', '#title')
            ->type('Lorem ipsum dolor sit amet.', '#content')
            ->press('Create Page');

        $this->seeInDatabase('pages', [
            'title' => 'Test Page',
        ]);
    }

    /**
     * Verify that pages can be updated.
     */
    public function testPageUpdate()
    {
        $this->be($this->adminUser);

        $page = Page::create([
            'title' => 'Test Edit Page',
            'content' => 'Lorem ipsum',
        ]);

        $page->save();

        $this->visit(route('pages.edit', [$page->slug]))
            ->type('Updated Test Page', '#title')
            ->type('Industry standard dummy text.', '#content')
            ->press('Update Page');

        $this->seeInDatabase('pages', [
            'title' => 'Updated Test Page',
        ]);

        $this->notSeeInDatabase('pages', [
            'title' => 'Test Edit Page',
        ]);
    }
}
