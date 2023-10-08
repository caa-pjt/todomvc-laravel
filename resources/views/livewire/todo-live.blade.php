<div>
    <header class="header">
        <h1>todos</h1>
        <form method="POST" wire:submit="store">
            <input class="new-todo" placeholder="Créer un nouveau todo ?" autofocus type="text" wire:model='title'>
        </form>
    </header>

    @if ($todos && $numberOfTodos > 0)
    <section class="main">
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            @foreach ($todos as $todo)
            <li class="@if($todo->completed === 1) completed @endif">
                <div class="view">
                    <input class="toggle" type="checkbox" @if ($todo->completed === 1)
                    checked
                    @endif wire:click="update({{ $todo->id }})">
                    <label>{{ $todo->title }}</label>
                    
                    <button class="destroy" wire:loading.attr="disabled" wire:click.prevent="destroy({{ $todo }})"></button>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
    <footer class="footer">
        <span class="todo-count">{{ $countTodosLeft }} item left</span>
        <ul class="filters">
            <li>
                <a href="/todos" @class(['selected' => $url === ""]) wire:click.prevent='getTodos()'>All</a> 
            </li>
            <li>
                <a href="?s=active" @class(['selected' => $url === "active"]) wire:click.prevent='getTodos("active")'>Active</a>
            </li>
            <li>
                <a href="?s=completed" @class(['selected' => $url === "completed"])  wire:click.prevent='getTodos("completed")'>Completed</a>
            </li>
        </ul>
        @if ($todos && count($todos) > 0 && $numberOfTodos - $countTodosLeft > 0)
        <button class="clear-completed" wire:click='destroy()'>Clear completed</button>
        @endif
    </footer>
    @endif 
    <script>
        let links = document.querySelectorAll(".filters li a")
        links.forEach(element => {
            element.addEventListener('click', (event) => {
                event.preventDefault()
                const nouvelleURL = event.currentTarget.getAttribute("href")
                console.log(nouvelleURL)
                window.history.pushState({}, '', nouvelleURL);
            })
        });
    </script>

</div>
