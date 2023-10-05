@extends('layout')

@section('title', "Créer un nouveau Todo")

@section('content')

<div class="row">
  <h1>Créer un nouveau todo</h1>

  @include('todo.form')

</div>

@endsection