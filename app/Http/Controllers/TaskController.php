<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
class TaskController extends Controller
{
    public function __construct(public TaskService $taskService)
    {
    }
    public function index(): Response
    {
        $perPage = request('noperpage', 10);
        $orderColumn = request('ordercolumn', 'created_at');
        $orderDirection = request('orderdirection', 'desc');
        $search = request('search', '');

        $tasks = (TaskResource::collection(
            $this->taskService->paginationTaskQuery(
                (int)$perPage,
                $orderColumn,
                $orderDirection,
                $search
            )
        ));

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
            'search' => $search,
            'noperpage' => $perPage,
            'ordercolumn' => $orderColumn,
            'orderdirection' => $orderDirection,
        ]);
    }

    public function create(): Response
    {
        $status = StatusEnum::toArrayComponent();

        return Inertia::render('Tasks/Create', [
            'status' => $status
        ]);
    }

    public function store(StoreTaskRequest $request):Redirector|RedirectResponse
    {
        try {

            $this->taskService->create($request->validated());

            return redirect('/tasks')->with('status', ['type' => 'success', 'text' => 'Task Successfully Saved']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect('/tasks')->with(
                'status',
                ['type' => 'error', 'text' =>
                'An error has occured whilst saving task, please try again']
            );
        }
    }

    public function show(Task $task): Response
    {
        return Inertia::render('Tasks/Show', [
            'task' => $task
        ]);
    }

    public function edit(Task $task): Response
    {
        $status = StatusEnum::toArrayComponent();

        return Inertia::render('Tasks/Edit', [
            'task' => $task,
            'status' => $status
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task):Redirector|RedirectResponse
    {
        try {

            if ($request->user()->cannot('update', $task)) {
                return redirect('/tasks')->with(
                    'status',
                    ['type' => 'error', 'text' =>
                    'User is not authorized to update this task']
                );
            }

            $this->taskService->update($request->validated(), $task);

            return redirect('/tasks')->with('status', ['type' => 'success', 'text' => 'Task Successfully Updated']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect('/tasks')->with(
                'error',
                'An error has occured whilst saving task, please try again'
            );
        }
    }

    public function destroy(Task $task):Redirector|RedirectResponse
    {
        try {

            if (request()->user()->cannot('delete', $task)) {
                return redirect('/tasks')->with(
                    'status',
                    ['type' => 'error', 'text' =>
                    'User is not authorized to delete this task']
                );
            }

            $this->taskService->delete($task);

            return redirect('/tasks')->with('status', ['type' => 'success', 'text' => 'Task Successfully Deleted']);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect('/tasks')->with(
                'status',
                ['type' => 'error', 'text' =>
                'An error has occured whilst saving task, please try again']
            );
        }
    }
}
