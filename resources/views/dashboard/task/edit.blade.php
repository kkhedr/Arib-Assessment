@extends('master')

@section('title', 'edit Department')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">update task</h4>
      <form action="{{ route('tasks.update', $task->id) }}" method="post" class="forms-sample">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">desc</label>
          <input type="text" class="form-control" id="desc" name="desc" value="{{ $task->desc }}">
        </div>

        <button type="submit" class="btn btn-primary me-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

