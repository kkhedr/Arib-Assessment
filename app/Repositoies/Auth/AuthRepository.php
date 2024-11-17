<?php

namespace App\Repositoies\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface{

    private User $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function login($email, $password){
        if(Auth::attempt(['email' => $email, 'password' => $password])){ 
            $user = Auth::user();
            return $user;
        } 
        return null;
    }
}