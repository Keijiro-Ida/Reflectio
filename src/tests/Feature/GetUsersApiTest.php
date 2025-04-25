<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUsersApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_users_api_returns_user_list(): void
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/users');

        $response->assertStatus(200)
            ->assertJsonCount(3);

    }
}
