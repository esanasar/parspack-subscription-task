<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class subscriptionLogTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExpiredSubscriptionCount()
    {
        $response = $this->get('/api/v1/subscriptionLog/expiredCount');

        $jsonResponse = '{
            "data":{
                "count" : 0 
            }
        }';

        $arrayResponse = json_decode($jsonResponse, true);
        $response->assertJson($arrayResponse);
        $response->assertStatus(200);
    }
}
