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
                  @if(auth()->user()->hasPermission('employee-create'))
                    <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">create</a>
                  @endif
                    <h4 class="card-title">employees</h4>
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>email</th>
                            <th>full_name</th>
                            <th>salary</th>
                            <th>image</th>
                            <th>department</th>
                            <th>is_manager</th>
                            <th>actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($employees as $employee)
                          <tr>
                          <td>{{ $employee->id }}</td>
                          <td>{{ $employee->email }}</td>
                            <td>{{ $employee->full_name }}</td>
                            <td>{{ $employee->salary }}</td>
                            <td> <img src="{{ $employee->image_path }}" height="200px" width="200px"> </td>
                            <td>{{ $employee->department->name }}</td>
                            <td>{{ $employee->manager != null ? $employee->manager->full_name : 'yes' }}</td>
                           
                            <td>
                            @if(auth()->user()->hasPermission('employee-update'))
                             <!-- Update button (Redirects to the edit page) -->
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Update</a>
                            @endif

                            @if(auth()->user()->hasPermission('employee-delete'))
                            <!-- Delete form -->
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @endif
                            </td> 
                          </tr>
                          @endforeach
                        
                        </tbody>
                      </table>
                      {{ $employees->links() }}
                    </div>
                  </div>
                </div>
              </div>
@endsection

