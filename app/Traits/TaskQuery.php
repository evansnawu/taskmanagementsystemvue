<?php

namespace App\Traits;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

trait TaskQuery
{
    public function paginationTaskQuery(
        int $perPage,
        string $orderColumn,
        string $orderDirection,
        string $search
    ): Collection|LengthAwarePaginator {

        if ($search || ($orderColumn != 'created_at')) {

           return $this->filterTaskQuery(
                $orderColumn,
                $orderDirection,
                $search
            )->paginate($perPage);
        }

        return collect($this->cacheTaskQuery())
            ->paginate($perPage);
    }

    public function filterTaskQuery(
        string $orderColumn,
        string $orderDirection,
        string $search
    ): Builder {
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
        )->when(
            $orderColumn != 'created_at',
            function ($query) use ($orderColumn, $orderDirection) {
                return $query->orderBy($orderColumn, $orderDirection);
            }
        );
    }
    public function cacheTaskQuery(): Collection
    {
        return cache()->rememberForever(
            'tasks_' . auth()->id(),
            function () {
                return $this->taskQuery()->orderBy('tasks.created_at', 'desc')->get();
            }
        );
    }

    public function taskQuery(): Builder
    {
        return Task::with('user');
    }
}
