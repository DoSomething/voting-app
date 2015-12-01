<?php

use VotingApp\LocalizedDate;

class LocalizedDateTest extends TestCase
{
    /**
     * Verify that US-style MM/DD/YYYY dates can be parsed.
     * @test
     */
    public function testMMDDYYYYDates()
    {
        $date = new LocalizedDate('1/2/1990', 'US');

        $this->assertInstanceOf('VotingApp\LocalizedDate', $date);

        $this->assertSame(631238400, $date->getTimestamp());
    }

    /**
     * Verify that international-style DD/MM/YYYY dates can be parsed.
     * @test
     */
    public function testDDMMYYYYDates()
    {
        $date = new LocalizedDate('2/1/1990', 'GB');

        $this->assertInstanceOf('VotingApp\LocalizedDate', $date);

        $this->assertSame(631238400, $date->getTimestamp());
    }

    /**
     * Test that other non-standard strtotime() formats
     * still work as expected.
     * @test
     */
    public function testOtherFormats()
    {
        $date = new LocalizedDate('January 2nd 1990', 'US');
        $this->assertSame(631238400, $date->getTimestamp());

        $date2 = new LocalizedDate('January 2, 1990', 'US');
        $this->assertSame(631238400, $date2->getTimestamp());

        $date3 = new LocalizedDate('2 January 1990', 'US');
        $this->assertSame(631238400, $date3->getTimestamp());
    }

    /**
     * Test that given strings are validated/invalidated.
     * @test
     */
    public function testValidate()
    {
        $this->assertTrue(LocalizedDate::validate('1/25/1990', 'US'));

        $this->assertTrue(LocalizedDate::validate('1-25-1990', 'US'));

        $this->assertTrue(LocalizedDate::validate('1.25.1990', 'US'));

        $this->assertTrue(LocalizedDate::validate('25/1/1990', 'GB'));

        $this->assertTrue(LocalizedDate::validate('25-1-1990', 'GB'));

        $this->assertFalse(LocalizedDate::validate('25/1/1990', 'US'));

        $this->assertTrue(LocalizedDate::validate('January 2nd 1990', 'US'));
    }
}
