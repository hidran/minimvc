<?php
namespace App\Models;
use \PDO;
class Post {
    protected $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    
    public function all()
    {
        $result = [];
        $stm = $this->conn->query('select * from posts ORDER BY datecreated DESC');
       
       
        if($stm && $stm->rowCount()){
            
            $result =  $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    
    }
    public function find($id){
        
        $result = [];
        
         $sql = 'select * from posts where id = :id';
         
         $stm = $this->conn->prepare($sql);
         
         $stm->execute(['id' => $id]);
        
         if($stm){
             
             $result = $stm->fetch(PDO::FETCH_OBJ);
         }
         return $result;
         
         
       
    }
    
    public function save(array $data = [])
    {
        $sql = 'INSERT INTO POSTS (email, title, message,datecreated)';
        $sql .= 'values (:email, :title, :message,:datecreated)';
        
        $stm = $this->conn->prepare($sql);
        
        $stm->execute([
            'email' => $data['email'],
            'message'=>  $data['message'],
             'title'=>  $data['title'],
             'datecreated' =>date('Y-m-d H:i:s')
            
        ]);
        
        return $stm->rowCount();
    }
    
    public function store(array $data = [])
    {
          //   
   
    
        $sql = 'UPDATE POSTS SET email =:email, title =:title, ';
        $sql .=' message =:message';
        $sql .= ' WHERE id = :id';
        
        $stm = $this->conn->prepare($sql);
        
        $stm->execute([
            'id' => $data['id'],
            'email' => $data['email'],
            'message'=>  $data['message'],
             'title'=>  $data['title']
                ]
                );
        
              return $stm->rowCount();
         
        
        
       
    }
     public function delete(int $id)
    {
          //   
   
    
        $sql = 'DELETE FROM  POSTS  WHERE id = :id';
        
        $stm = $this->conn->prepare($sql);
         $stm->bindParam(':id',$id, PDO::PARAM_INT);
        $stm->execute();
        
              return $stm->rowCount();
         
        
        
       
    }
}
