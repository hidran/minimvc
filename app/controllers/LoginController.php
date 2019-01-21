<?php
namespace App\Controllers;
use App\Models\User;

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

        $this->content = view('login', [
            'token' => $this->generateToken(),
            'signup' => 0
        ]);
    }
    public function showSignup()
    {
        $this->content = view('login',
            [
                'token' => $this->generateToken(),
                'signup' => 1
            ]
        );
    }
    public function logout()
    {
        $_SESSION = [];
        redirect('/auth/login');
    }
    public function login()
    {
        $token = $_POST['_csrf'] ?? '';
        $email  = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = $this->verifyLogin($email, $password, $token);
        if($result['success']){
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            unset($result['user']['password']);
            $_SESSION['userData']  = $result['user'];
            redirect('/');


        } else {
            $_SESSION['message'] = $result['message'];
            redirect('/auth/login');
        }
    }
    public function signup()
    {
        $token = $_POST['_csrf'] ?? '';
        $email  = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $username = $_POST['username'] ?? '';
        $result = $this->verifySignup($email, $password, $token);

        if($result['success']){

            $user = new User($this->conn);

            $data['email']  = $email;
            $data['username']  = $email;
            $data['password']  =password_hash($password, PASSWORD_DEFAULT);

            $resultSave = $user->saveUser($data);
            if($resultSave['success']) {
                $data['id'] = $resultSave['id'];
                session_regenerate_id();

                $_SESSION['loggedin'] = true;
                unset($data['password']);
                $_SESSION['userData'] = $data;
                redirect('/');
            } else {
                $_SESSION['message'] = $resultSave['message'];
                redirect('/auth/showSignup');
            }


        } else {
            $_SESSION['message'] = $result['message'];
            redirect('/auth/login');
        }
    }
    private   function verifySignup($email, $password, $token){


        $result = [
            'message' => 'USER SIGNED UP CORRECTLY',
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
        $user = new User($this->conn);
        $resEmail = $user->getUserByEmail($email);

        if($resEmail){
            $result = [
                'message' => 'A USER ALREADY EXISTS WITH THIS EMAIL',
                'success' => false

            ];
            return $result;
        }



        return $result;
    }
 private   function verifyLogin($email, $password, $token){


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
        $user = new User($this->conn);
        $resEmail = $user->getUserByEmail($email);

        if(!$resEmail){
            $result = [
                'message' => 'USER NOT FOUND',
                'success' => false

            ];
            return $result;
        }

        if(!password_verify($password, $resEmail->password)){
            $result = [
                'message' => 'WRONG PASSWORD',
                'success' => false

            ];
            return $result;
        }
        $result['user'] = (array)$resEmail ;

        return $result;
    }


}
