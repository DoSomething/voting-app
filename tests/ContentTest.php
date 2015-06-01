<?php

class ContentTest extends TestCase
{

    /**
     * Verify that the homepage loads correctly.
     * @test
     */
    public function testHomepage()
    {
        $this->visit('/');
    }

}
