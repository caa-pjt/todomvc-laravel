<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase; // Pour réinitialiser la base de données entre les tests

    /**
     * A basic feature test example.
     */
    public function test_redirect(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_get_all_todos(): void
    {
        Todo::factory(3)->create(); // Créer trois Todos pour les besoins du test

        $response = $this->get(route("todos.index"));

        $response->assertStatus(200);
    }

    public function test_create_todo()
    {

        $data = [
            "title" => "Super todo",
            "completes" => 0
        ];

        $response = $this->post(route("todos.store"), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('todos.index'));
    }


    public function test_update_todo()
    {

        $todo = Todo::factory()->create();

        $this->assertInstanceOf(Todo::class, $todo);

        $data = [
            "title" => "Super todo",
            "completes" => 1
        ];

        $response = $this->put(route('todos.update', ["todo" => $todo]), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('todos.index'));
    }


    public function test_delete_todo()
    {

        $todo = Todo::factory()->create();

        $response = $this->delete(route("todos.destroy", ["todo" => $todo]));

        $response->assertStatus(302);
        $response->assertRedirect(route('todos.index'));
    }
}
