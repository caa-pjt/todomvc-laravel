<div>
    <header class="header">
        <h1>todos</h1>
        <!-- Add todos to the db -->
        <form method="POST" wire:submit="store">
            <input class="new-todo" placeholder="Créer un nouveau todo ?" autofocus type="text" wire:model='title'>
        </form>
    </header>
    <!-- check if have todos -->
    @if ($todos && $numberOfTodos > 0)
    <section class="main">
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            <!-- List of Todos -->
            @foreach ($todos as $todo)
            <li class="@if($todo->completed === 1) completed @endif" wire:key='{{ $todo->id }}'>
                <div class="view">
                    <input class="toggle" type="checkbox" @if ($todo->completed === 1)
                    checked
                    @endif wire:click="update({{ $todo->id }})">
                    <label>{{ $todo->title }}</label>

                    <button class="destroy" wire:loading.attr="disabled"
                        wire:click.prevent="destroy({{ $todo }})"></button>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
    <footer class="footer">
        <span class="todo-count">{{ $countTodosLeft }} item left</span>
        <ul class="filters">
            <li>
                <a href="/" @class(['selected'=> $url === ""]) wire:click.prevent='getTodos()'>All</a>
            </li>
            <li>
                <a href="?s=active" @class(['selected'=> $url === "active"])
                    wire:click.prevent='getTodos("active")'>Active</a>
            </li>
            <li>
                <a href="?s=completed" @class(['selected'=> $url === "completed"])
                    wire:click.prevent='getTodos("completed")'>Completed</a>
            </li>
        </ul>
        @if ($todos && count($todos) > 0 && $numberOfTodos - $countTodosLeft > 0)
        <button class="clear-completed" wire:click='destroyTodos()'>Clear completed</button>
        @endif
    </footer>
    @endif

    <script>
        /**
         *  Détection de l'historique du changement de la page
        */ 
        window.addEventListener('popstate', function(event) {
            console.log('Changement de page détecté ! Nouvelle URL : ' + document.location.href);
            const filter = location.search
            let link = ""
            if(filter != ""){
                link = document.querySelector(`[href="${filter}"]`)
            } else {
                link = document.querySelector("[href='/']")
            }
            if(link){
                link.click()
            }
        });
    </script>

</div>