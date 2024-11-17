@extends('master')

@section('title', 'Create Area')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Create Employee</h4>
      <form action="{{ route('employees.store') }}" method="post" class="forms-sample" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required maxlength="255" placeholder="Enter email">
        </div>

        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" required maxlength="255" placeholder="Enter first name">
        </div>

        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" required maxlength="255" placeholder="Enter last name">
        </div>

        <div class="form-group">
          <label for="salary">Salary</label>
          <input type="number" class="form-control" id="salary" name="salary" required placeholder="Enter salary">
        </div>

        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>

        <div class="form-group">
          <label for="department_id">Department</label>
          <select class="form-control" id="department_id" name="department_id" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
              <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="is_employee">Is Employee</label>
          <select class="form-control" id="is_employee" name="is_employee" required>
            @if(auth()->user()->hasRole('admin'))
            <option value="1">Yes</option>
            <option value="0">No</option>
            @else
            <option value="1">Yes</option>
            @endif
          </select>
        </div>

        <div class="form-group" id="manager_id_group" >
          <label for="manager_id">Manager</label>
          <select class="form-control" id="manager_id" name="manager_id">
            <option value="">Select Manager</option>
            @foreach($managers as $manager)
              <option value="{{ $manager->id }}">{{ $manager->full_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group" id="permission_id_group" >
          <label for="permission_id">Permissions</label>
          <select class="form-control" id="permission_id" name="permissions[]" multiple>
            <option value="">Select permissions</option>
            @foreach($permissions as $permission)
              <option value="{{ $permission->id }}">{{ $permission->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" required minlength="8" placeholder="Enter password">
        </div>

        <button type="submit" class="btn btn-primary me-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // When department changes, fetch the corresponding managers
    $('#department_id').change(function() {
      var departmentId = $(this).val(); // Get selected department ID

      if (departmentId) {
        // Send an AJAX request to fetch managers by department
        $.ajax({
          url: '{{ url('/get-managers') }}/' + departmentId,
          type: 'GET',
          success: function(data) {
            // Clear existing options in the manager dropdown
            $('#manager_id').empty();
            $('#manager_id').append('<option value="">Select Manager</option>');

            // Loop through the managers and append to the dropdown
            $.each(data, function(key, manager) {
              $('#manager_id').append('<option value="' + manager.id + '">' + manager.full_name + '</option>');
            });

            // If the manager dropdown is hidden, show it
            $('#manager_id_group').show();
          },
          error: function() {
            alert('Error fetching managers');
          }
        });
      } else {
        // If no department is selected, hide the manager dropdown
        $('#manager_id_group').hide();
      }
    });

    // Initially hide the manager dropdown
    $('#manager_id_group').hide();
  });
</script>

