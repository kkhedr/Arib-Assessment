@extends('master')

@section('title', 'Assign Task')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">assgin task</h4>
      <form action="{{ route('assign-tasks.store') }}" method="post" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="form-group" id="manager_id_group" >
          <label for="task_id">tasks</label>
          <select class="form-control" id="task_id" name="task_id">
            <option value="">Select task</option>
            @foreach($tasks as $task)
              <option value="{{ $task->id }}">{{ $task->desc }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group" id="manager_id_group" >
          <label for="employee_id">tasks</label>
          <select class="form-control" id="employee_id" name="employee_id">
            <option value="">Select employee</option>
            @foreach($employees as $employee)
              <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary me-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

