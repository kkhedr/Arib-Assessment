<?php

namespace App\Http\Requests\AssignTask;

use Illuminate\Foundation\Http\FormRequest;

class AssignTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->isMethod('post') ? $this->store() : $this->update();
    }

    public function store(){
        return [
            'employee_id' => 'required|int|exists:users,id',
            'task_id' =>  'required|int|exists:tasks,id',
        ];
    }

    public function update(){
        return [
            'status' => 'required|in:pending,waiting,completed',
        ];
    }
}
