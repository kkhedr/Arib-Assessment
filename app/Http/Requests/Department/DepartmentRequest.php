<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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

    private function store(){
        return [
            'name' => 'required|string|max:255'
        ];
    }

    private function update(){
        return [
            'name' => 'nullable|string|max:255'
        ];
    }
}
