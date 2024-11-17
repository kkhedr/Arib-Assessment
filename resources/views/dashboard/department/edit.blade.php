@extends('master')

@section('title', 'edit Department')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Create Department</h4>
      <form action="{{ route('departments.update', $department->id) }}" method="post" class="forms-sample">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" maxlength="255" placeholder="Enter name">
        </div>

        <button type="submit" class="btn btn-primary me-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

