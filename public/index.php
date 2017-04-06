<?php
chdir(dirname(__DIR__));
require_once __DIR__.'/../core/bootstrap.php';

$data = require 'config/database.php';

$appConfig = require 'config/app.config.php';

try{

$conn = App\db\DbFactory::create($data)->getConn();

$router = new Router($conn);

$router->loadRoutes($appConfig['routes']);

$controller = $router->dispatch();

$controller->display();

} catch(\PDOException $e){
    echo $e->getMessage();
}
/*
 die();

$controller->show(1);
$controller->display();
 */
