<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositoies\Employee\{EmployeeInterface, EmployeeRepository};
use App\Repositoies\Department\{DepartmentInterface, DepartmentRepository};
use App\Repositoies\Permission\{PermissionInterface, PermissionRepository};
use App\Repositoies\Role\{RoleInterface, RoleRepository};
use App\Repositoies\Auth\{AuthInterface, AuthRepository};
use App\Repositoies\Task\{TaskInterface, TaskRepository};
use App\Repositoies\Task\AssignTask\{AssignTaskRepository, AssignTasknterface};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);
        $this->app->bind(AssignTasknterface::class, AssignTaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
