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
      <script src="/js/jquery.js" ></script>
  </head>

  <body>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/">COMMENTING SYSTEM</a>
      <ul class="nav navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/posts">POSTS</a>
        </li>
          <?php if(isUserLoggedin()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="/post/create">NEW POST</a>
        </li>
          <?php endif;?>
      </ul>
        <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
            <?php
            if(isUserLoggedin()) :
                ?>
                <li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings">
                        <i class="fa fa-cog fa-fw fa-lg"></i></a></li>




                        <li class="nav-link">
                            <h5> Welcome <?=getUserLoggedInFullname()?></h5>

                        </li>
                <li class="m-1">&nbsp;</li>

                        <li class="nav-item">
                            <form class="form" role="form" method="post" action="/auth/logout">
                                <input type="hidden" name="action" value="logout">
                                <button  class="btn btn-link">LOGOUT</button>
                            </form>
                        </li>

                </li>
            <?php
            else: ?>
                <li class="nav-link">
                    <a href="/auth/signup" class="btn btn-lg btn-primary">SIGN UP</a>
                    <a href="/auth/login" class="btn btn-lg btn-success">LOGIN</a>

                </li>
            <?php
            endif;

            ?>
        </ul>
    </nav>

    <div class="container">
   <?=$this->content?>
    </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->

      <script src="/js/tether.js" ></script>
     <script src="/js/bootstrap.min.js"></script>
  </body>
</html>