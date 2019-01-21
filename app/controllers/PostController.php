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
  
    private function redirectIfNotLoggedIn()
    {
        if(!isUserLoggedin()){
            redirect('/auth/login');
        }
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
        $this->redirectIfNotLoggedIn();
           $post = $this->Post->find($postid);
         
          $this->content =   view('editPost', compact('post'));
     
    }
    public function create(){
        $this->redirectIfNotLoggedIn();
        $this->content = view('newPost');
    }
    
    
  public function save(){

      $this->redirectIfNotLoggedIn();
            $data = $_POST;
            $data['user_id'] = getUserId();
            $this->Post->save($data);
           
            redirect('/');
    
        
    }
   public function store(string $id){
       $this->redirectIfNotLoggedIn();
         try {
             $post = $this->Post->find($_POST['id']);
             if($post->user_id != getUserId()){
                 $_SESSION = [];
                 redirect('/auth/login');
             }
           $result = $this->Post->store($_POST);
           redirect('/');
           
         } catch (PDOException $e){
            return $e->getMessage();
        }
    
        
   }
  public function delete( $id){
      $this->redirectIfNotLoggedIn();
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
         $data = $_POST;
       $data['post_id']  = (int) $postid;
       $data['user_id']= (int)getUserId();

         $comment->save($data);
           
            redirect('/post/'.$postid);
   }
}

