<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\Auth\AuthRequest;

class AuthController extends Controller
{
    private AuthService $service;
    public function __construct(AuthService $service){
        $this->service = $service;
    }

   public function loginPage(){
    if(auth()->user()){
      return redirect('/employees');
    }
    return view('login');
   }

   public function login(AuthRequest $request){
    $user = $this->service->login($request->email, $request->password);
    if(!$user){
        return redirect('/login')->with(['failed' => __('messages.loginWrong')]);
    }
    return redirect('/employees')->with(['success' => $user->last_name.' was logged']);
   }

   public function logout(){
    auth()->logout();
    return redirect('/login');
   }
}
