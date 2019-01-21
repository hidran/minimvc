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
        $sql = 'select p.* , u.email from posts as p  INNER JOIN users as u';
        $sql .= ' ON u.id=p.user_id ORDER BY p.datecreated DESC';
        $stm = $this->conn->query($sql);
       
       
        if($stm && $stm->rowCount()){
            
            $result =  $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    
    }
    public function find($id){
        
        $result = [];
        
         $sql = 'select p.* , u.email from posts  as p  INNER JOIN users as u';
        $sql .= ' ON u.id=p.user_id where p.id = :id';
         
         $stm = $this->conn->prepare($sql);

         $stm->execute(['id' => $id]);
        
         if($stm){
             
             $result = $stm->fetch(PDO::FETCH_OBJ);
         }
         return $result;
         
         
       
    }
    
    public function save(array $data = [])
    {
        $sql = 'INSERT INTO POSTS (user_id, title, message,datecreated)';
        $sql .= 'values (:user_id, :title, :message,:datecreated)';
        
        $stm = $this->conn->prepare($sql);
        
        $stm->execute([
            'user_id' => $data['user_id'],

            'message'=>  $data['message'],
             'title'=>  $data['title'],
             'datecreated' =>date('Y-m-d H:i:s')
            
        ]);
        
        return $stm->rowCount();
    }
    
    public function store(array $data = [])
    {
          //   
   
    
        $sql = 'UPDATE POSTS SET title =:title, ';
        $sql .=' message =:message';
        $sql .= ' WHERE id = :id';
        
        $stm = $this->conn->prepare($sql);
        
        $stm->execute([
            'id' => $data['id'],
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
