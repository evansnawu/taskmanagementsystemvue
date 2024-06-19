<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge(['user_id' => auth()->id()]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'duedate' => ['required', 'date', 'after_or_equal:today'],
            'description' => ['required', 'string'],
            'status' => ['required'],
            'user_id' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter task title',
            'title.string' => 'Task title must be a string',
            'duedate.required' => 'Please select task due date',
            'duedate.date' => 'Due date must be a validate date',
        ];
    }
}
