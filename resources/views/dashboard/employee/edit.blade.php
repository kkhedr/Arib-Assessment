@extends('master')

@section('title', 'Create Area')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Update Employee</h4>
      <form action="{{ route('employees.update', $employee->id) }}" method="post" class="forms-sample" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required maxlength="255" placeholder="Enter email" value="{{ old('email', $employee->email) }}">
        </div>

        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" required maxlength="255" placeholder="Enter first name" value="{{ old('first_name', $employee->first_name) }}">
        </div>

        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" required maxlength="255" placeholder="Enter last name" value="{{ old('last_name', $employee->last_name) }}">
        </div>

        <div class="form-group">
          <label for="salary">Salary</label>
          <input type="number" class="form-control" id="salary" name="salary" required placeholder="Enter salary" value="{{ old('salary', $employee->salary) }}">
        </div>

        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*">
          @if($employee->image)
            <img src="{{ $employee->image_path }}" alt="Employee Image" width="100" class="mt-2">
          @endif
        </div>

        <div class="form-group">
          <label for="department_id">Department</label>
          <select class="form-control" id="department_id" name="department_id" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
              <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                {{ $department->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="is_employee">Is Employee</label>
          <select class="form-control" id="is_employee" name="is_employee" required>
            <option value="1" {{ old('is_employee', $employee->is_employee) == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_employee', $employee->is_employee) == '0' ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <div class="form-group" id="manager_id_group">
          <label for="manager_id">Manager</label>
          <select class="form-control" id="manager_id" name="manager_id">
            <option value="">Select Manager</option>
            @foreach($managers as $manager)
              <option value="{{ $manager->id }}" {{ old('manager_id', $employee->manager_id) == $manager->id ? 'selected' : '' }}>
                {{ $manager->full_name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group" id="permission_id_group">
          <label for="permission_id">Permissions</label>
          <select class="form-control" id="permission_id" name="permissions[]" multiple>
            @foreach($permissions as $permission)
              <option value="{{ $permission->id }}" 
                {{ in_array($permission->id, old('permissions', $employee->permissions->pluck('id')->toArray())) ? 'selected' : '' }}>
                {{ $permission->name }}
              </option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary me-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

