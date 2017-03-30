<?php

namespace Tests\Unit;

use App\Models\Agent;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KMeansExtendedTest extends TestCase
{
    /**
     * @var \App\Algorithms\KMeansExtended
     */
    private $kmeans;

    public function setUp() {
        parent::setUp();
        $this->kmeans = $this->app->make('App\Algorithms\KMeansExtended');
        $this->kmeans->addPoint([10, 50]);
        $this->kmeans->addPoint([20, 40]);
        $this->kmeans->addPoint([20, 20]);
        $this->kmeans->addPoint([30, 20]);
        $this->kmeans->addPoint([40, 50]);
    }

    /**
     * Test valid response.
     *
     * @return void
     */
    public function testValidInput()
    {
        $agent1 = new Agent('test1', '18922');
        $agent1->setCoordinates([10, 34]);
        $agent2 = new Agent('test2', '63882');
        $agent2->setCoordinates([20, 40]);
        $agents = [
            $agent1, $agent2
        ];
        $this->assertTrue(true, is_array($this->kmeans->solve($agents)));
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function testInvalidArguments()
    {
        // Invalid array
        $this->kmeans->solve([1, 2, 3]);
    }

    /**
     * @expectedException \App\Exceptions\InvalidArgumentException
     */
    public function testInvalidArguments2()
    {
        // Agents without coordinates
        $agent1 = new Agent('test1', '18922');
        $agent2 = new Agent('test2', '63882');
        $agents = [
            $agent1, $agent2
        ];
        $this->kmeans->solve($agents);
    }
}
