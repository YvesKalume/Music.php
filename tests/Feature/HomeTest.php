<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    public function testHomeUnauthenticated()
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function testHomeAuthenticated()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
