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
        $tasks = Task::all();
        return  $tasks;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules = [
            'user_id' => 'required',
            'title'   => 'required',
            'description' => 'required'

        ];
        $feedback = ['required' => 'O campo :attribute é obrigatório'];
        $request->validate($rules, $feedback);
        $task = Task::create($request->all());
        return response()->json($task,201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $task = Task::find($id);
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
        $task = Task::find($id);
        if($task === null){
            return response()->json(['erro' => 'Não foi possivel atualizar a tarefa, id não existe'],404);

       }
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
