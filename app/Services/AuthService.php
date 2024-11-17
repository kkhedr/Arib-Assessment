<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositoies\Auth\AuthInterface;


class AuthService{
    private AuthInterface $auth;
   

    public function __construct(AuthInterface $auth){
        $this->auth = $auth;
    }

    public function login($email, $password){
        return  $this->auth->login($email, $password);
    }



    
}