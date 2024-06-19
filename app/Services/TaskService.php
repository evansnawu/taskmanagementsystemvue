<?php

namespace App\Services;

use App\Models\Task;
use App\Traits\TaskQuery;

class TaskService
{
    use TaskQuery;

    /**
     *
     * @param array{title: string, description: string, status: StatusEnum::class, duedate: \date, user_id: int} $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return  Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'duedate' => $data['duedate'],
            'user_id' => $data['user_id'],
        ]);
    }

        /**
     *
     * @param array{title: string, description: string, status: StatusEnum::class, duedate: \date} $data
     * @return Task
     */
    public function update(array $data, Task $task): bool
    {
        return  $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'duedate' => $data['duedate'],
        ]);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}
