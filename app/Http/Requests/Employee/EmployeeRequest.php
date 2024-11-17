<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\isManagerRule;


class EmployeeRequest extends FormRequest
{
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
           'email' => 'required|email|max:255',
           'first_name' => 'required|string|max:255',
           'last_name' => 'required|string|max:255',
           'salary' => 'required|numeric',
           'image' => 'required|image|mimes:png,jpg,jpeg|max:50000',
           'department_id' => 'required|int|exists:departments,id',
           'is_employee' => 'required|in:0,1',
           'manager_id' => [
            function ($attribute, $value, $fail) {
                if ($this->is_employee == 0 && $value !== null) {
                    $fail('The manager_id must be null when the user is not an employee.');
                }
            }
            , 'required_if:is_employee,==,1', 
            new isManagerRule()],
           'password' => ['required','string','min:8','regex:/[A-Z]/','regex:/[a-z]/','regex:/[0-9]/','regex:/[@$!%*?&]/'],
           'permissions' => 'nullable|array',
           'permissions.*' => 'required|int|exists:permissions,id',
       ];
   }

   private function update(){
       return [
        'email' => 'nullable|email|max:255',
        'fisrt_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'salary' => 'nullable|numeric',
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:50000',
        'department_id' => 'nullable|int|exists:departments,id',
        'is_employee' => 'nullable|in:0,1',
        'manager_id' => [
            function ($attribute, $value, $fail) {
                if ($this->is_employee == 0 && $value !== null) {
                    $fail('The manager_id must be null when the user is not an employee.');
                }
            }
            , 'required_if:is_employee,==,1', 
            new isManagerRule()],
        'permissions' => 'nullable|array',
        'permissions.*' => 'required|int|exists:permissions,id',   
    ];
   }

   protected function prepareForValidation()
   {
       if ($this->is_employee == 0) {
           $this->merge([
               'manager_id' => null,
           ]);
       }
   }
}
