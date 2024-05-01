<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\TaskRepository;
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

        $taskRepository = new TaskRepository($this->task);
        return  $taskRepository->getAllTask();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $taskRepository = new TaskRepository($this->task);
        $request->validate($taskRepository->getModel()->rules(), $taskRepository->getModel()->feedback());
        $taskNew = $taskRepository->createTask($request->all());
        return response()->json($taskNew, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $taskRepository = new TaskRepository($this->task);
        $task = $taskRepository->getByIdTask($id);
        if ($task === null) {
            return response()->json(['erro' => 'Não existe uma tarefa com esse id'], 404);
        }
        return $task;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $taskRepository = new TaskRepository($this->task);
        $request->validate($taskRepository->getModel()->rules(), $taskRepository->getModel()->feedback());
        $task = $taskRepository->updateTask($id, $request->all());
        if ($task === null) {
            return response()->json(['erro' => 'Não foi possível atualizar a tarefa, id não existe'], 404);
        }
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $taskRepository = new TaskRepository($this->task);
        $task = $taskRepository->deleteTask($id);;
        if ($task === null) {
            return response()->json(['erro' => 'Não foi possivel deletar a tarefa, id não existe'], 404);
        }
        return  [
            'message' => "A tarefa foi deletada com sucesso",
        ];
    }
}
