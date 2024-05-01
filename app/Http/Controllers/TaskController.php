<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $task = new Task();
        $tasks = $task->with('user')->get();
        return  $tasks;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = new Task();
        $request->validate($task->rules(), $task->feedback());
        $taskNew = $task::create($request->all());
        return response()->json($taskNew,201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {  
       $task = new Task();
       $taskUser = $task->with('user')->find($id);
       if($taskUser === null){
            return response()->json(['erro' => 'Não existe uma tarefa com esse id'],404);
       }
        return $taskUser;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $task = Task::find($id);
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
        $task = Task::find($id);
        if($task === null){
            return response()->json(['erro' => 'Não foi possivel deletar a tarefa'],404);

       }
        $task->delete();
        return  [
            'message' => "A tarefa foi deletada com sucesso",
        ];
    }
}
