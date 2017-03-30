<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    public function testOnlyGet()
    {
        $response = $this->post('/');
        $response->assertStatus(405);
        
        $response = $this->put('/');
        $response->assertStatus(405);
    }
}
