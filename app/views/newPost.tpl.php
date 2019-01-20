<div class="row">
    <div class="col-md-6 push-md-3">
        
 
<h1>Create new post</h1>

<form action="/post/save" method="POST">
    
    <div class="form-group">
        
        <label for="email">Email</label>
        <input class="form-control" name="email" type="email"  name="email" i="email" required>
           
    </div>
      <div class="form-group">
        
        <label for="title">Title</label>
        <input  name="title" class="form-control" type="text"  name="title" i="title" required>
           
    </div>
       <div class="form-group">
        
        <label for="title">Message</label>
        <textarea required name="message" class="form-control" name="message" i="message"></textarea>
           
    </div>
    <div class="form-group text-md-center">
        <button class="btn  btn-success">Save</button>
    </div>
</form>
   </div>
</div>
