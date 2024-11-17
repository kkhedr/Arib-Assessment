<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item nav-category">Actions</li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Area</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  @if(auth()->user()->hasPermission('employee-read'))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('employees.index') }}">employees</a></li>
                  @endif
                  @if(auth()->user()->hasPermission('department-read'))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('departments.index') }}">departments</a></li>
                  @endif
                  @if(auth()->user()->hasPermission('task-read'))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('tasks.index') }}">tasks</a></li>
                  @endif
                  @if(auth()->user()->hasPermission('assign_task-read'))
                  <li class="nav-item"> <a class="nav-link" href="{{ route('assign-tasks.index') }}">myTasks</a></li>
                  @endif
                </ul>
              </div>
            </li>

          </ul>
        </nav>