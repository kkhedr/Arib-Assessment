<?php

namespace App\Repositoies\Employee;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Filter\Elements\User\UserFilters;
use Illuminate\Support\Facades\Auth;


class EmployeeRepository implements EmployeeInterface{

    private Department $department;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(array $request, UserFilters $filters){
      return $this->user->with(['department', 'manager'])->filter($filters)->where('is_admin', 0)->paginate(isset($request['per_page']) ? $request['per_page'] : 10);
    }

    public function managers(){
        $user = Auth::user();
        if($user->hasRole('manager')){
            return $this->user->select('id', 'first_name', 'last_name')->where('id' ,$user->id)->where('is_admin', 0)->get();
        }
        return $this->user->select('id', 'first_name', 'last_name')->whereNull('manager_id')->where('is_admin', 0)->get();
    }

    public function getManagersByDepartment($department_id){
        $user = Auth::user();
        if($user->hasRole('manager')){
            return $this->user->select('id', 'first_name', 'last_name')->whereNull('manager_id')->where('is_admin', 0)->where('department_id', $department_id)->where('id', $user->id)->get();
        }
        return $this->user->select('id', 'first_name', 'last_name')->whereNull('manager_id')->where('is_admin', 0)->where('department_id', $department_id)->get();
    }

    public function find($id){
        return $this->user->with(['department', 'manager'])->findOrFail($id);
    }

    public function create($data){
        return $this->user->create($data);
    }

    public function update($data, $id){
        $user = $this->user->findOrFail($id);
        if(!$user){
            return null;
        }
        $path = 'uploads/employee/';
        if(isset($data['image']) && Storage::exists($path.$user->image)){
            Storage::delete($path.$user->image);
        }
        $user->update($data);
        return $user->fresh();
    }

    public function destroy($id){
        $user = $this->user->find($id);
        if(!$user){
            return null;
        }
        $user->delete();
    }
}