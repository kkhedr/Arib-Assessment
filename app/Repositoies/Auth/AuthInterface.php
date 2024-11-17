<?php

namespace App\Repositoies\Auth;


interface AuthInterface{
    public function login($email, $password);
}