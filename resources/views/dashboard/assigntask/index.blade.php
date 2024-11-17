@extends('master')

@section('title', 'Create Area')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
               <form>
               <div class="form-group">
                <input type="text" class="form-control" id="email" name="search" placeholder="Search - first,last name and email">
              </div>

              <button type="submit" class="btn btn-primary me-2">search</button>
               </form>
                  <div class="card-body">
                  @if(auth()->user()->hasPermission('assign_task-create'))
                     <a href="{{ route('assign-tasks.create') }}" class="btn btn-primary btn-sm">create</a>
                  @endif
                    <h4 class="card-title">tasks</h4>
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>task id</th>
                            <th>employee</th>
                            <th>createdBy</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $task)
                          <tr>
                          <td>{{ $task->id }}</td>
                          <td>{{ $task->task_id }}</td>
                          <td>{{ $task->employee->full_name }}</td>
                          <td>{{ $task->manager->full_name }}</td>
                          </tr>
                          @endforeach
                        
                        </tbody>
                      </table>
                      {{ $data->links() }}
                    </div>
                  </div>
                </div>
              </div>
@endsection

