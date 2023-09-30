@php
    $methode = $todo->title ? $methode = 'PUT' : 'POST';
@endphp

<form method="POST" action="{{ route($todo->title ? 'todos.update' : 'todos.store', [$todo]) }}">
    
    <!-- CSRF Token / Methode -->
    @csrf
    @method($methode)

    
    <div class="form-group mb-3">
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="Titre du todo" value="{{ old('title', $todo->title) }}" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-check mt-3 mb-3">
        <input type="checkbox" class="form-check-input" id="todoFinished" name="completed" @if($todo->completed || old('completed', $todo->completed)) checked @endif value="1">
        <label class="form-check-label" for="todoFinished">Todo terminé ?</label>
    </div>
    <div class="form-group mt-3">
        <button class="btn btn-primary" type="submit">Créer un nouveau todo</button>
    </div>

</form>