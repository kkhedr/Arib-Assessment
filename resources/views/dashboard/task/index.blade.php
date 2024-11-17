@extends('master')

@section('title', 'Create Area')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                 
                  <div class="card-body">
                  @if(auth()->user()->hasPermission('task-create'))
                     <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">create</a>
                  @endif
                    <h4 class="card-title">tasks</h4>
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($tasks as $task)
                          <tr>
                          <td>{{ $task->id }}</td>
                          <td>{{ $task->desc }}</td>
                            <td>
                             <!-- Update button (Redirects to the edit page) -->
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Update</a>

                            <!-- Delete form -->
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </td> 
                          </tr>
                          @endforeach
                        
                        </tbody>
                      </table>
                      {{ $tasks->links() }}
                    </div>
                  </div>
                </div>
              </div>
@endsection

