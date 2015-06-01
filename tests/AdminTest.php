<?php

use VotingApp\Models\User;

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
        $this->adminUser->assignRole(1);

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


    // Could add more here in the future!

}
