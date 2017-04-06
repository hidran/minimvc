<?php

namespace App\Models;
use \PDO;

class Post {
    protected $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    public function all(){
        
        $result = [];
        $stm = $this->conn->query('SELECT * FROM posts ORDER BY datecreated DESC');
        
        if($stm){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }
    
    public function find($id){
        
        $result = [];
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stm = $this->conn->prepare($sql);
        $stm->execute(['id' => $id]);
        
        if($stm){
            $result = $stm->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }
    
    public function save(array $data = []){
        
        $sql = 'INSERT INTO posts (email, title, message, datecreated)';
        $sql .= 'values(:email, :title, :message, :datecreated)';
        
        $stm = $this->conn->prepare($sql);
        $stm->execute([
            'email' => $data['email'],
            'message' => $data['message'],
            'title' => $data['title'],
            'datecreated' => date('Y-m-d H:i:s')
        ]);
        
        return $stm->rowCount();
    }
    
}
