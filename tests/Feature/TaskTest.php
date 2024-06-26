<?php

use App\Enums\StatusEnum;
use App\Events\TaskCompleted;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use function Pest\Laravel\get;

use function Pest\Laravel\actingAs;
use Yajra\DataTables\Facades\DataTables;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->task = Task::factory()->create([
        'user_id' => $this->user->id
    ]);
});


test('can see home page', function () {

    Task::truncate();

    actingAs($this->user)
    ->get('/tasks')
        ->assertStatus(200);

});


test('index contains non empty table', function () {

    actingAs($this->user)
    ->get('/tasks')
        ->assertStatus(200)
        ->assertDontSeeText(__('Showing to of 0 results'));
});


test('can show create page', function () {
    $response = $this->actingAs($this->user)->get('/tasks/create');

    $response->assertStatus(200);
});

test('create task successfully', function () {

    $task = [
        'title' => 'Title 1',
        'description' => 'description 1',
        'duedate' => '2024-10-10',
        'status' => StatusEnum::In_Progress->value,
        'user_id' => $this->user->id,
    ];

    actingAs($this->user)
        ->post('/tasks', $task)
        ->assertStatus(302)
        ->assertRedirect('tasks');

    $this->assertDatabaseHas('tasks', $task);

});

test('task create validation error redirects form with errors', function () {

    $response = actingAs($this->user)->post(
        '/tasks',
        [
            'title' => '',
            'duedate' => ''
        ]
    );

    $response->assertStatus(302)
        ->assertInvalid(['title', 'duedate']);
});


test('task edit contains correct values', function () {


    actingAs($this->user)->get('tasks/' . $this->task->id . '/edit')
        ->assertStatus(200)
        ->assertSee($this->task->title, false)
        ->assertSee($this->task->description, false);
});

test('task update validation error redirects back to form', function () {

    actingAs($this->user)->put('tasks/' . $this->task->id, [
        'title' => '',
        'duedate' => '',
        'description' => '',
        'status' => '',
        'user_id' => '',
    ])
        ->assertStatus(302)
        ->assertInvalid(['title', 'duedate'])
        ->assertSessionHasErrors(['title', 'duedate']);
});


test('task delete successful', function () {

    actingAs($this->user)
        ->delete('tasks/' . $this->task->id)
        ->assertStatus(302)
        ->assertRedirect('tasks');

    $this->assertDatabaseMissing('tasks', $this->task->toArray());
    $this->assertModelMissing($this->task);

});

test('task edited successfully', function () {

    $this->task->title = "changed title";
    $this->task->status = StatusEnum::Completed->value;
    $this->task->description = 'description changed';
    $this->task->duedate = '2026-01-30';

     actingAs($this->user)
        ->put(url('tasks' , $this->task->id), $this->task->toArray())
        ->assertStatus(302);

    $this->assertDatabaseHas('tasks', $this->task->toArray());
});


test('task show contains correct values', function () {

    actingAs($this->user)->get('tasks/' . $this->task->id)
        ->assertStatus(200)
        ->assertSee($this->task->title, false)
        ->assertSee($this->task->duedate, false);
});

test('task completion fires events', function () {

    Event::fake();

    $task = Task::factory()->create([
        'user_id' => $this->user->id,
        'status' => StatusEnum::Pending->value,
    ]);

    $task->title = "changed title";
    $task->status = StatusEnum::Completed->value;
    $task->description = 'description changed';
    $task->duedate = '2026-01-30';

     actingAs($this->user)
        ->put(url('tasks' , $task->id), $task->toArray())
        ->assertStatus(302);

    Event::assertDispatched(TaskCompleted::class);
});
