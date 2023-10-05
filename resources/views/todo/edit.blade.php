@extends('layout')

@section('title', "Editer - $todo->title")

@section('content')


<h1>Editer le todo "{{ $todo->title }}"</h1>

  @include('todo.form')
    
@endsection