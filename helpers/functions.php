<?php

function view($view, array $data = []){
    extract($data);
    ob_start();
    require __DIR__.'/../app/views/'.$view.'.tpl.php';
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}

function redirect($url ='/'){
    header('Location:'.$url);
    exit;
}