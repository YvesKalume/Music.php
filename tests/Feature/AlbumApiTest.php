<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;

class AlbumApiTest extends TestCase
{
    public function testIndexUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums');
        $response->assertStatus(401);
    }

    public function testIndexAuthenticated() {
        Passport::actingAs(User::find(1), ['*']);

        $response = $this->json('GET', '/api/albums');
        $response->assertStatus(200);
    }

    public function testCreateUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums/create');
        $response->assertStatus(401);
    }

    public function testCreateAuthenticated()
    {
        Passport::actingAs(User::find(1), ['*']);

        $response = $this->json('GET', '/api/albums/create');
        $response->assertStatus(404);
    }

    // public function testStoreUnauthenticated()
    // {
    //     $response = $this->json('GET', '/api/albums');
    //     $response->assertStatus(401);
    // }
    //
    // public function testStoreAuthenticated()
    // {
    //     Passport::actingAs(User::find(1), ['*']);
    //     $response = $this->json('GET', '/api/albums');
    //     $response->assertStatus(200);
    // }

    public function testShowUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(401);
    }

    public function testShowAuthenticated()
    {
        Passport::actingAs(User::find(1), ['*']);
        $response = $this->json('GET', '/api/albums/1');
        $response->assertStatus(200);
    }

    public function testEditUnauthenticated()
    {
        $response = $this->json('GET', '/api/albums/1/edit');
        $response->assertStatus(404);
    }

    public function testEditAuthenticated()
    {
        Passport::actingAs(User::find(1), ['*']);
        $response = $this->json('GET', '/api/albums/1/edit');
        $response->assertStatus(404);
    }

    // public function testUpdateUnauthenticated()
    // {
    //     $response = $this->json('GET', '/api/albums/1');
    //     $response->assertStatus(401);
    // }
    //
    // public function testUpdateAuthenticated()
    // {
    //     Passport::actingAs(User::find(1), ['*']);
    //     $response = $this->json('GET', '/api/albums/1');
    //     $response->assertStatus(200);
    // }
    //
    // public function testDeleteUnauthenticated()
    // {
    //     $response = $this->json('GET', '/api/albums/1');
    //     $response->assertStatus(401);
    // }
    //
    // public function testDeleteAuthenticated()
    // {
    //     Passport::actingAs(User::find(1), ['*']);
    //     $response = $this->json('GET', '/api/albums/1');
    //     $response->assertStatus(200);
    // }

}
