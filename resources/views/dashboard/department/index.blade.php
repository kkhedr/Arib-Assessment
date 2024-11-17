@extends('master')

@section('title', 'Create Area')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
               <form>
               <div class="form-group">
                <input type="text" class="form-control" id="email" name="search" placeholder="Search - name">
              </div>

              <button type="submit" class="btn btn-primary me-2">search</button>
               </form>

                 

                  <div class="card-body">
                  @if(auth()->user()->hasPermission('department-create'))
                     <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">create</a>
                  @endif
                    <h4 class="card-title">Departments</h4>
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>employees count</th>
                            <th>salary sum</th>
                            <th>actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($departments as $department)
                          <tr>
                          <td>{{ $department->id }}</td>
                          <td>{{ $department->name }}</td>
                            <td>{{ $department->employees_count }}</td>
                            <td>{{ $department->employees_sum_salary }}</td>
                            
                            <td>
                            @if(auth()->user()->hasPermission('department-update'))
                            
                                 <!-- Update button (Redirects to the edit page) -->
                                 <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm">Update</a>
                            @endif
                        
                            @if(auth()->user()->hasPermission('department-delete'))
                            <!-- Delete form -->
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
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
                      {{ $departments->links() }}
                    </div>
                  </div>
                </div>
              </div>
@endsection

