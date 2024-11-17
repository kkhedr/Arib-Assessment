@extends('master')

@section('title', 'Create Area')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Create task</h4>
      <form action="{{ route('tasks.store') }}" method="post" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="desc">desc</label>
          <input type="text" class="form-control" id="desc" name="desc" required>
        </div>

        <button type="submit" class="btn btn-primary me-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

