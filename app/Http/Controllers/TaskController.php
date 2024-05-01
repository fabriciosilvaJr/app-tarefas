<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $task;


    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
      
        $tasks = $this->task->with('user')->get();
        return  $tasks;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $request->validate($this->task->rules(), $this->task->feedback());
        $taskNew = $this->task::create($request->all());
        return response()->json($taskNew,201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {  
    
       $task = $this->task->with('user')->find($id);
       if($task === null){
            return response()->json(['erro' => 'Não existe uma tarefa com esse id'],404);
       }
        return $task;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $task = $this->task->find($id);
        if($task === null){
            return response()->json(['erro' => 'Não foi possivel atualizar a tarefa, id não existe'],404);

       }
        $request->validate($task->rules(), $task->feedback());
        $task->update($request->all());
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $task = $this->task->find($id);
        if($task === null){
            return response()->json(['erro' => 'Não foi possivel deletar a tarefa'],404);

       }
        $task->delete();
        return  [
            'message' => "A tarefa foi deletada com sucesso",
        ];
    }
}
