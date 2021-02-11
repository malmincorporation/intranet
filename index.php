<?php

require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new \Bramus\Router\Router();

$header = getallheaders();
$input = json_decode(file_get_contents('php://input'), true);

$router->before('POST|GET|PUT|DELETE', '/api/.*', function() {
  header("Content-type: application/json; charset=utf-8");
});

include_once './routes/user.php';
//include_once './routes/database.php';

$router->run();

?>
