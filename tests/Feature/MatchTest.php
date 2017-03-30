<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MatchTest extends TestCase {
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOnlyPost() {
        $response = $this->post('/match');
        $response->assertStatus(200);

        $response = $this->put('/match');
        $response->assertStatus(405);

        $response = $this->get('/match');
        $response->assertStatus(405);
    }

    public function testInvalidZipCodes()
    {
        $response = $this->post('/match', ['agent-a-zip' => 'skjdhakjsdh sadj', 'agent-b-zip' => 'ajsjsjsjkaj']);
        $response->assertStatus(200);
    }
}
