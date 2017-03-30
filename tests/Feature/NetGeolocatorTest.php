<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NetGeolocatorTest extends TestCase
{
    /**
     * @var \App\Services\LocalGeolocator
     */
    private $locator;

    public function setUp()
    {
        parent::setUp();
        $this->locator = $locator = $this->app->make('App\Services\NetGeolocator');
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
     * Tests that an exception is thrown when the code is not found.
     */
    public function testInvalidZip()
    {
        $this->assertEquals(true, is_array($this->locator->getCoordinatesByZipCode('19027')));
        $this->assertEquals(true, is_array($this->locator->getCoordinatesByZipCode('aslkjska  a sk')));
        $this->assertEquals(true, is_array($this->locator->getCoordinatesByZipCode('ñññ')));
        $this->assertEquals(true, is_array($this->locator->getCoordinatesByZipCode('')));
    }
}
