<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
  </head>

  <body>

    <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
      <a class="navbar-brand" href="/">COMMENTING SYSTEM</a>
      <ul class="nav navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/posts">POSTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/post/create">NEW POST</a>
        </li>
      </ul>
    </nav>

    <div class="container">
   <?=$this->content?>
    </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="/js/jquery.js" ></script>
      <script src="/js/tether.js" ></script>
     <script src="/js/bootstrap.min.js"></script>
  </body>
</html>