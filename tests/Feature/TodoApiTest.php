<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Todo;
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

    public function test_store_todo()
    {
        $this->login();

        $data = [
            "title" => "Mon todo",
            "completed" => 0
        ];

        $response = $this->post("/api/todos", $data);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "title" => "Mon todo",
            "completed" => 0
        ]);
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

        $todos = Todo::factory(1)->create();
        $todo = $todos->first();

        $data = [
            "title" => "Nouveau titre"
        ];

        $response = $this->putJson("/api/todos/" . $todo->id, $data);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "title" => "Nouveau titre"
        ]);
    }

    public function test_finished_methode_return_completed_todos(): void
    {
        Todo::factory(2)->completed()->create();
        Todo::factory(2)->create();

        $response = $this->get('/api/completed');


        $response->assertJsonCount(2);
    }


    private function login()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
    }
}
