<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
     


require_once __DIR__ . '/../db/DBPDO.php';

require_once __DIR__ . '/../db/DbFactory.php';

require_once __DIR__ . '/../app/controllers/PostController.php';

require_once __DIR__ . '/../app/models/Post.php';

require_once __DIR__ . '/../app/models/Comment.php';

require_once __DIR__ . '/../helpers/functions.php';

require_once __DIR__ . '/../core/Router.php';