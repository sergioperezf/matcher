<?php

namespace Tests\Unit;

use App\Exceptions\ZipNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LocalLocatorTest extends TestCase
{
    /**
     * @var \App\Services\LocalGeolocator
     */
    private $locator;

    public function setUp()
    {
        parent::setUp();
        $this->locator = $locator = $this->app->make('App\Services\LocalGeolocator');
    }

    /**
     * Tests valid zip codes.
     *
     * @return void
     */
    public function testValidZip()
    {
        $this->assertEquals([40.073118, -75.124431], $this->locator->getCoordinatesByZipCode('19027'));
    }

    /**
     * Tests that an exception is thrown when the code is not found.
     * 
     * @expectedException \App\Exceptions\ZipNotFoundException
     */
    public function testInvalidZip()
    {
        $this->locator->getCoordinatesByZipCode('19027a');
    }
}
