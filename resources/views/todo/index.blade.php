@extends('layout')

@section('content')

@livewire('todo-live')

<!-- Used only in PHP -->
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

{{-- @dump($todos) --}}
      
@endsection
      