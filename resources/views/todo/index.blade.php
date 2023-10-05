@extends('layout')

@section('content')

<header class="header">
  <h1>todos</h1>
  <form method="POST" action="{{ route('todos.store') }}">
    <input class="new-todo" placeholder="Créer un nouveau todo ?" autofocus type="text" name="title">
    <!-- CSRF Token / Methode -->
    @csrf
    @method('POST')
  
  </form>
  {{-- <a class="new-todo" href="{{ url('todos/create') }}">Céer un nouveau todo</a> --}}
</header>

<section class="main">
  <input id="toggle-all" class="toggle-all" type="checkbox">
  <label for="toggle-all">Mark all as complete</label>
  <ul class="todo-list">
    @foreach ($todos as $todo)
    <li class="">
      <div class="view">
        <input class="toggle" type="checkbox">
        <label>{{ $todo->title }}</label>
        <button class="destroy"></button>
      </div>
    </li>
    @endforeach
  </ul>
</section>
<footer class="footer">
  <span class="todo-count"></span>
  <ul class="filters">
    <li>
      <a href="#/" class="selected">All</a>
    </li>
    <li>
      <a href="#/active">Active</a>
    </li>
    <li>
      <a href="#/completed">Completed</a>
    </li>
  </ul>
  <button class="clear-completed">Clear completed</button>
</footer>

{{-- <table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>Todo</th>
      <th>Completed</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
    <tr>
      <li>{{ $todo->id }}</li>
      <td>{{ $todo->created_at->format('Y-m-d') }}</td>
      <td>{{ $todo->title }}</td>
      <td><input class="form-check-input" type="checkbox" disabled  @if ($todo->completed === 1)
        checked
        @endif id="flexCheckDefault"></td>
        <td><a class="btn btn-primary" href="{{ route('todos.edit', ['todo' => $todo])}}">Editer</a></td>
        <td>
          <form method="post" action="{{ route('todos.destroy', $todo->id ) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Supprimer</button>
          </form>
        </td>
      </tr>


        @endforeach

  </tbody>
</table> --}}

      {{-- <p>{{ $todo->title }} - <input class="form-check-input" type="checkbox"  @if ($todo->completed === 1)
        checked
        @endif id="flexCheckDefault"></p> --}}
{{-- @dump($todos) --}}
      
@endsection
      