<?php
/**
 * Created by PhpStorm.
 * User: hidran
 * Date: 20/01/2019
 * Time: 22:01
 */

namespace App\Models;
use PDO;

class User
{
  protected  $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    function delete(int $id){

        /**
         * @var $conn mysqli
         */
        $conn = $GLOBALS['mysqli'];

        $sql = 'DELETE FROM users WHERE id ='.$id;

        $res = $conn->query($sql);
        return $res && $conn->affected_rows;
    }
    function getUser(int $id){

        /**
         * @var $conn mysqli
         */
        $conn = $GLOBALS['mysqli'];
        $result = [];
        $sql = 'SELECT *  FROM users WHERE id ='.$id;
        // echo $sql;

        $res = $conn->query($sql);
        if($res && $res->num_rows) {
            $result = $res->fetch_assoc();
        }
        return  $result;
    }
    public function getUserByEmail(string $email){

        /**
         * @var $conn mysqli
         */

        $result = [];
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if(!$email){
            $result;
        }


        $sql = 'SELECT *  FROM users WHERE email = :email';
        echo $sql.$email;

        $stm = $this->conn->prepare($sql);

        $stm->execute(['email' => $email]);

        if($stm){

            $result = $stm->fetch(PDO::FETCH_OBJ);

        }
        return $result;
    }
    function storeUser(array $data, int $id){

        /**
         * @var $conn mysqli
         */
        $result = [
            'success' => 1,
            'affectedRows' => 0,
            'error' => ''
        ];

        $conn = $GLOBALS['mysqli'];
        $username = $conn->escape_string($data['username']);
        $email = $conn->escape_string($data['email']);
        $fiscalcode = $conn->escape_string($data['fiscalcode']);
        $avatar =  $conn->escape_string($data['avatar']);



        $age = $conn->escape_string($data['age']);
        $sql = 'UPDATE users SET ';
        $sql .= "username='$username', email='$email',fiscalcode='$fiscalcode',";
        $sql .= "age=$age, avatar = '$avatar'";
        if($data['password']){

            $data['password'] = $data['password'] ?? 'testuser';

            $password =  password_hash($data['password'], PASSWORD_DEFAULT);
            $sql .= ", password='$password'";
        }
        if($data['roletype']){
            $roletype =  in_array($data['roletype'], getConfig('roletypes', []))? $data['roletype'] : 'user';
            $sql .= ",roletype='$roletype'";
        }
        $sql .= ' WHERE id ='.$id;
        // print_r($data);
        // echo $sql;die;

        $res = $conn->query($sql);
        if($res) {
            $result['affectedRows'] =  $conn->affected_rows;

        } else {
            $result['success'] = false;
            $result['error'] = $conn->error;
        }
        return  $result;
    }

    function saveUser(array $data){

        /**
         * @var $conn mysqli
         */


        $result = [
            'id' => 0,
            'success' => false,
            'message' => 'PROBLEM SAVING USER',

        ] ;



        $sql = 'INSERT INTO users (username, email, password, roletype) ';
        $sql .= " VALUES(:username, :email,:password, :roletype)";
        //echo $sql;
        $stm = $this->conn->prepare($sql);

        if($stm) {
            $res = $stm->execute([
                'username'=> $data['username'],
                'email'=> $data['email'],
               'password'=> $data['password'],
                'roletype' => $data['roletype'] ?? 'user'

            ]);
            if($res){
                $result['success']  = 1;
                $res['id'] = $this->conn->lastInsertId();

            } else {
                $result['success']  = $this->conn->errorInfo();;
            }
        } else {
            $result['message'] = $this->conn->errorInfo();
        }
        return  $result;
    }
    function updateUserAvatar(int $id, string $avatar = null){
        if(!$avatar) {
            return false;
        }
        $conn = $GLOBALS['mysqli'];
        $avatar =  $conn->escape_string($avatar);
        $sql = "UPDATE users SET avatar = '$avatar' WHERE id =$id ";

        $res = $conn->query($sql);
        return $res && $conn->affected_rows;

    }

}