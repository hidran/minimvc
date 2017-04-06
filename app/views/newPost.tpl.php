<div class="row">
    <div class="col-md-6 push-3">
    <h1>create new Post</h1>
    <form method="POST" action="/post/save">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control rounded-0" type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="title">Titolo</label>
            <input class="form-control rounded-0" type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="message">Messagio</label>
            <textarea class="form-control rounded-0"  
                      name="message" id="message" required></textarea>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success rounded-0" type="submit">Salva</button>
        </div>
    </form>    
    </div>
    
</div>