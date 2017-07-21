<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testPasswordGrant()
    {
        $response = $this->json('POST', '/api/oauth/grant/password', [
            'email' => 'admin@admin.com',
            'password' => 'secret',
        ]);

        $response->assertStatus(200)->assertJson([
            'token_type' => true,
            'expires_in' => true,
            'access_token' => true,
            'refresh_token' => true,
        ]);

    }
}
