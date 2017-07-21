<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;

class AlbumRouteTest extends TestCase
{
    public function testIndexRouteUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums');
        $response->assertStatus(401);
    }

    public function testIndexRouteAuthenticated() {
        Passport::actingAs(User::find(1), ['*']);

        $response = $this->json('GET', '/api/albums');
        $response->assertStatus(200);
    }

    // public function testCreateUnauthenticated()
    // {
    //     $response = $this->json('GET', '/api/albums/create');
    //     $response->assertStatus(401);
    // }
    //
    // public function testCreateAuthenticated()
    // {
    //     Passport::actingAs(User::find(1), ['*']);
    //
    //     $response = $this->json('GET', '/api/albums/create');
    //     $response->assertStatus(200);
    // }

    public function testStoreRouteUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums');
        $response->assertStatus(401);
    }

    public function testStoreRouteAuthenticated()
    {
        Passport::actingAs(User::find(1), ['*']);
        $response = $this->json('GET', '/api/albums');
        $response->assertStatus(200);
    }

    public function testShowRouteUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(401);
    }

    public function testShowRouteAuthenticated()
    {
        Passport::actingAs(User::find(1), ['*']);
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(200);
    }

    public function testEditUnauthenticated()
    {
        $response = $this->get('/albums/1/edit');
        $response->assertRedirect('/login');
    }

    public function testEditAuthenticated()
    {
        $response = $this->actingAs(User::find(1))->get('/albums/1/edit');
        $response->assertStatus(200);
    }

    public function testUpdateRouteUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(401);
    }

    public function testUpdateRouteAuthenticated()
    {
        Passport::actingAs(User::find(1), ['*']);
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(200);
    }

    public function testDeleteRouteUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(401);
    }

    public function testDeleteRouteAuthenticated()
    {
        Passport::actingAs(User::find(1), ['*']);
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(200);
    }

}
