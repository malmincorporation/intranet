<?php

include_once './controllers/DatabaseController.php';
$databaseController = new DatabaseController();

$router->before('POST|GET|PUT|DELETE', '/api/database/.*', function() use ($header) {
  if (isset($header["Application-Token"]) && $header["Application-Token"] != "1") {
    echo "No access.";
    exit();
  }
});

$router->post('/api/database/table/create', function() use ($databaseController, $input) {
  $v = new Valitron\Validator($input);
  $v->rule('required', ["tablename"]);

  if($v->validate()) {
    echo json_encode($databaseController->createTable($input["tablename"]));
  } else {
    print_r($v->errors());
  }
});

$router->post('/api/database/column/create', function() use ($databaseController, $input) {
  $v = new Valitron\Validator($input);
  $v->rule('required', ["tablename", "columnname", "columntype"]);

  if($v->validate()) {
    echo json_encode($databaseController->createColumn($input["tablename"], $input["columnname"], $input["columntype"]));
  } else {
    print_r($v->errors());
  }
});

$router->put('/api/database/column/change', function() use ($databaseController, $input) {
  $v = new Valitron\Validator($input);
  $v->rule('required', ["tablename", "columnname", "columntype"]);

  if($v->validate()) {
    echo json_encode($databaseController->updateColumn($input["tablename"], $input["columnname"], $input["columntype"]));
  } else {
    print_r($v->errors());
  }
});

$router->delete('/api/database/column/delete', function() use ($databaseController, $input) {
  $v = new Valitron\Validator($input);
  $v->rule('required', ["tablename", "columnname"]);

  if($v->validate()) {
    echo json_encode($databaseController->deleteColumn($input["tablename"], $input["columnname"]));
  } else {
    print_r($v->errors());
  }
});

?>
