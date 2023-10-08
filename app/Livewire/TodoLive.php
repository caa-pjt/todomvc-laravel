<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoLive extends Component
{
    // List of todos
    public $todos;

    // wire:model='title' -> Pour la création du todo
    public String $title;

    protected $rules = [
        'title' => 'required|min:2',
    ];

    // number of not finished todos
    public int $countTodosLeft;
    public int|null $numberOfTodos = null;

    // Search query
    public $search = '';

    // validation search query
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
    ];

    // Search valuea admited
    protected $searchValues = [
        "active" => 0,
        "completed" => 1
    ];


    /**
     * Load all todos when the app is loading..
     */
    public function mount(){
        // Get Todos from DB
        $this->getTodos($this->search); 
        // Count todos not finished
        //$this->countItemsLeft($this->todos);
    }
    
    /**
     * getTodos // Search todo where condition
     *
     * @param  mixed $param
     * @return Todo[]
     */
    public function getTodos(string $param = '') {

        $this->search = $param;
        
        if(array_key_exists($this->search, $this->searchValues)){

            // dd($this->search, $this->searchValues, array_key_exists($this->search, $this->searchValues), $this->searchValues[$this->search]);
            $todos = $this->todos = Todo::where('completed', $this->searchValues[$this->search])
            ->orderBy('created_at', 'desc')
            ->get();

        }else{
            $todos = $this->todos = Todo::all()->sortByDesc('created_at');
            $this->numberOfTodos = count($todos);
        }
        
        if(is_null($this->numberOfTodos)){
            $this->numberOfTodos = count(Todo::all());
        }
        $this->countItemsLeft($todos);

        return $this->todos = $todos;
        
    }

        
    /**
     * Filter todos and return the number of todos arr not been completed
     *
     * @param  mixed $todos
     * @return Int number of filtred todos 
     */
    public function countItemsLeft($todos) : Int {
        $items = $todos->filter(function($todo){
            return $todo->completed === 0 ?? $todo;
        });
        return $this->countTodosLeft = count($items);
    }

    
    /**
     * store a new Todo in database
     *
     * @return void
     */
    public function store() {
        
        $this->validate();

        Todo::create([
            "title" => $this->title
        ]);
        //$this->title = '';
        $this->reset();
        $this->getTodos();
    }

        
    /**
     * update Todo
     *
     * @param  mixed $id
     * @return void
     */
    public function update(int $id){
        $todo = Todo::findOrFail($id);
        if($todo->completed === 0){
            $todo->completed = 1;
            $this->countTodosLeft--;
        }else {
            $todo->completed = 0;
            $this->countTodosLeft++;
        }
        $todo->save();

        $this->getTodos();

    }

    /**
     * Delete a Todo from his id
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(Todo|null $todo = null){
        if($todo->id === null){
            Todo::where('completed', 1)->delete();
        }else{
            Todo::find($todo->id)->delete();;
        }

        $this->getTodos();
    }

    /**
     * Show Todo view with todos
     */
    public function render()
    {
        return view('livewire.todo-live', ["todos" => $this->todos, 'url' => $this->search]);
    }

}
