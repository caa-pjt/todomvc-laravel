<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use App\Models\User;

class TodoApiController extends Controller
{
    public function getToken()
    {
        $u = User::find(1);

        $token = $u->createToken('api');
        return response()->json($token);
    }

    public function index()
    {
        return response()->json(Todo::all()->sortByDesc('created_at'));
    }

    public function finished()
    {
        return response()->json(Todo::where("completed", "=", 1)->get());
    }

    public function store(StoreTodoRequest $request)
    {
        $t = Todo::create($request->except('_token', '_method'));
        return response()->json($t, 200);
    }

    public function update(StoreTodoRequest $request, Todo $todo)
    {
        $todo->update($request->except("_token", "_method"));
        return response()->json($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json($todo);
    }
}
