<?php


namespace App\Controllers;
use \PDO;
use App\Models\Post;
use App\Models\Comment;
/**
 * Description of PostController
 *
 * @author hidran@gmail.com
 */
class PostController extends  BaseController {

    protected $Post ;
    public function __construct(PDO $conn) {

         parent::__construct($conn);

        $this->Post = new Post($conn);
       
    }
  

        public function display()
    {
        require  $this->layout; 
    }
    
    public function getPosts()
    {
      
      $posts = $this->Post->all();
      
    $this->content =  view('posts', compact('posts'));
    }
    
    public  function show( $postid )
    {
       
          
           $post = $this->Post->find($postid);
           
            $comment = new Comment($this->conn);
           $comments =  $comment->all($postid);
          $this->content =   view('post', compact('post','comments'));
     
    }
      public function edit( $postid )
    {
        
           $post = $this->Post->find($postid);
         
          $this->content =   view('editPost', compact('post'));
     
    }
    public function create(){
        $this->content = view('newPost');
    }
    
    
  public function save(){
     
      
            $this->Post->save($_POST);
           
            redirect('/');
    
        
    }
   public function store(string $id){
         try {
        
           $result = $this->Post->store($_POST);
           redirect('/');
           
         } catch (PDOException $e){
            return $e->getMessage();
        }
    
        
   }
  public function delete( $id){
         try {
        
           $result = $this->Post->delete((int)$id);
           redirect('/');
           
         } catch (PDOException $e){
            return $e->getMessage();
        }
    
        
   }
   public function saveComment($postid)
   {
         $comment = new Comment($this->conn);
         $_POST['post_id'] = (int) $postid;
         $comment->save($_POST);
           
            redirect('/post/'.$postid);
   }
}

