<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TodoApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function tes_get_todos_not_logged_in(): void
    {
        $response = $this->getJson("/api/todos");

        $response->assertStatus(401);
    }

    public function test_get_todos_logged_in(): void

    {
        $this->login();

        $response = $this->getJson("/api/todos");

        $response->assertStatus(200);
    }

    public function test_post_todo_logged_in(): void
    {
        $this->login();

        $response = $this->postJson("/api/todos", ["title" => "test json post"]);

        $response->assertStatus(200)->assertJsonPath("title", "test json post");
    }

    public function test_post_update(): void
    {
        $this->login();
        // TodoApiTest::store(["title" => "Test de title"]);
    }


    private function login()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
    }
}
