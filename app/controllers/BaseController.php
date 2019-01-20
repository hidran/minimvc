<?php
namespace App\Controllers;
use PDO;
class BaseController
{
    protected $layout = 'layout/index.tpl.php';
    public $content ='Hidran Arias';
    protected $conn;
    public function __construct(PDO $conn) {

        $this->conn = $conn;



    }


    public function display()
    {
        require  $this->layout;
    }
}
