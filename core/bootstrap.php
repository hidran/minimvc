<?php
session_start();
require_once __DIR__ . '/../helpers/functions.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

function loadClass($className){
     $filename1 = str_replace(['App','Controllers','Models','DB\\'],
       ['app','controllers','models','db\\'], $className
    ).'.php' ;
    $filename2 =  str_replace('app\\','', $filename1);
    $filename3 = "core/$className.php";
     if(file_exists($filename1)){
         require $filename1;
     } elseif (file_exists($filename2)){
         require $filename2;
     }else {
         require $filename3;
     }
}
spl_autoload_register('loadClass');
/*
require_once __DIR__ . '/../db/DBPDO.php';

require_once __DIR__ . '/../db/DbFactory.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/models/Post.php';

require_once __DIR__ . '/../app/models/Comment.php';



require_once __DIR__ . '/../core/Router.php';
*/
