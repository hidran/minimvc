<?php
chdir(dirname(__DIR__));

  require  __DIR__.'/../core/bootstrap.php';

$data = require 'config/database.php';

$appConfig = require 'config/app.config.php';


try {
    
$conn = App\DB\DbFactory::create($data)->getConn();


$router  = new Router($conn);

$router->loadRoutes($appConfig['routes']);


   
    
   $controller = $router->dispatch();
   
   $controller->display();
   
} catch (\PDOException $e) {
    echo $e->getMessage();
} catch (\Exception $e){
       echo $e->getMessage();
}
 
