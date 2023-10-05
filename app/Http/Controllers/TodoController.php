<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\StoreTodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        // $todos = Todo::all()->sortByDesc('created_at');
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('todo.index', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $todo = new Todo();
        return view('todo.create', ['todo' => $todo]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
 
        //Todo::create($request->validated());
        Todo::create($request->all());

        return redirect()->route('todos.index')
        ->with('success', "Le todo à bien été sauveguardé");
    }

    /**
     * Display the specified resource.
     */
    /* 
    public function show(Todo $todo)
    {
        return Todo::find($todo);
        //return Todo::findOrFail($id);
    } 
    */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit', ['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTodoRequest $request, Todo $todo)
    {
        
        $request->input('completed') ?? $request->merge(['completed' => 0]);
        $todo->update($request->all());
        
        /* $completed = $request->input('completed') ?? 0;
        Todo::where('id', $todo->id)->update([
            'title' => $request->input('title'),
            'completed' => $completed
        ]); */

        return redirect()->route('todos.index')
        ->with('success', "Le todo à bien été sauveguardé");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //Todo::where('id', $todo->id)->delete();
        $todo->delete();
        return redirect()->route('todos.index')
        ->with('success', "Le todo à bien été supprimé");
    }
}
