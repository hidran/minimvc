<?php
namespace App\Controllers;
class LoginController extends BaseController
{

    public function showLogin()
    {
        $this->content = view('login');
    }
    public function showSignup()
    {
        $this->content = view('signup');
    }


}
