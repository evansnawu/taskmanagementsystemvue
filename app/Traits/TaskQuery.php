<?php

namespace App\Traits;

use App\Models\Task;

trait TaskQuery
{
    public function paginationTaskQuery(
        int $perPage,
        string $orderColumn,
        string $orderDirection,
        string $search
    ) {

        if ($search || ($orderColumn != 'created_at' )) {

            return $this->taskQuery()->when(
                $search,
                function ($query) use ($search) {
                    return  $query->whereAny(
                        [
                            'title',
                            'description',
                            'duedate',
                            'status'
                        ],
                        'LIKE',
                        "%$search%"
                    );
                }
            )->when(   $orderColumn != 'created_at' ,
                function ($query) use ($orderColumn, $orderDirection) {
                    return $query->orderBy($orderColumn, $orderDirection);
                }
            )->paginate($perPage);
        }

        return collect($this->cacheTaskQuery())
            ->paginate($perPage);
    }

    public function cacheTaskQuery()
    {
        return cache()->rememberForever(
            'tasks_' . auth()->id(),
            function () {
                return $this->taskQuery()->orderBy('tasks.created_at','desc')->get();
            }
        );
    }

    public function taskQuery()
    {
        return Task::with('user');
    }
}
