<?php
namespace App\Controllers;
class LoginController extends BaseController
{
    private function generateToken()
    {
        $bytes =random_bytes(32);

        $token = bin2hex($bytes);
        $_SESSION['csrf'] = $token;
        return $token;
    }
    public function showLogin()
    {

        $this->content = view('login', ['token' => $this->generateToken()]);
    }
    public function showSignup()
    {
        $this->content = view('signup');
    }
    public function login()
    {
        $token = $_POST['_csrf'] ?? '';
        $email  = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
    }

 private   function verifyLogin($email, $password, $token){

        require_once 'model/User.php';
        $result = [
            'message' => 'USERD LOGGED IN',
            'success' => true

        ];
        if($token !== $_SESSION['csrf']){
            $result = [
                'message' => 'TOKEN MISMATCH',
                'success' => false

            ];
            return $result;
        }
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$email){
            $result = [
                'message' => 'WRONG EMAIL',
                'success' => false

            ];
            return $result;
        }
        if(strlen($password) < 6){
            $result = [
                'message' => 'PASSWORD TOO SMALL',
                'success' => false

            ];
            return $result;
        }
        $resEmail = getUserByEmail($email);
        if(!$resEmail){
            $result = [
                'message' => 'USER NOT FOUND',
                'success' => false

            ];
            return $result;
        }

        if(!password_verify($password, $resEmail['password'])){
            $result = [
                'message' => 'WRONG PASSWORD',
                'success' => false

            ];
            return $result;
        }
        $result['user'] = $resEmail ;
        return $result;
    }


}
