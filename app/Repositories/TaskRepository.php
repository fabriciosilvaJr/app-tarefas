<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class TaskRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllTask()
    {
        return $this->model->with('user')->get();
    }

    public function getByIdTask($id)
    {

        return $this->model->with('user')->find($id);;
    }


    public function createTask(array $task)
    {
        return $this->model->create($task);
    }

    public function updateTask($id, array $data)
    {
        $task = $this->model->find($id);
        if ($task === null) {
            return null;
        }

        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        $task = $this->model->find($id);
        if ($task === null) {
            return null;
        }
        $task->delete();
        return $task;
    }

    public function getModel()
    {
        return $this->model;
    }
}
