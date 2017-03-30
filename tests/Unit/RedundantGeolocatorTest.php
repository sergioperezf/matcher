<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RedundantGeolocatorTest extends TestCase
{
    /**
     * @var \App\Services\LocalGeolocator
     */
    private $locator;

    public function setUp()
    {
        parent::setUp();
        $this->locator = $locator = $this->app->make('App\Services\RedundantGeolocator');
    }

    /**
     * Tests valid zip codes.
     *
     * @return void
     */
    public function testValidZip()
    {
        $this->assertEquals(true, is_array($this->locator->getCoordinatesByZipCode('19027')));
    }

    /**
     * Tests that an exception is thrown when the code is invalid.
     * 
     * @expectedException \App\Exceptions\ZipNotValidException
     */
    public function testInvalidZip()
    {
        $this->locator->getCoordinatesByZipCode('ñññ');
    }
}
