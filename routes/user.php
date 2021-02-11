<?php

include_once './controllers/UserController.php';
$userController = new UserController("users");
$userController->create();

$router->post('/api/user', function() use ($userController, $input) {
  $v = new Valitron\Validator($input);
  $v->rule('required', ["first_name", "last_name", "username", "password"]);

  if (isset($input["password"])) {
    $input["password"] = sha1($input["password"]);
  }

  if ($userController->isUserUnique($input)) {
    if($v->validate()) {
        echo json_encode($userController->post($input));
    } else {
        print_r($v->errors());
    }
  } else {
    die("The user is not unique.");
  }

});

$router->get('/api/user', function() use ($userController) {
  echo json_encode($userController->all([
    "id", "first_name", "last_name", "username", "password"
  ]));
});

$router->get('/api/user/{id}', function($id) use ($userController) {
  echo json_encode($userController->get([
    "id", "first_name", "last_name", "username", "password"
  ], $id));
});

$router->put('/api/user/{id}', function($id) use ($userController, $input) {
  echo json_encode($userController->put($input, $id));
});

$router->delete('/api/user/{id}', function($id) use ($userController) {
  echo json_encode($userController->delete($id));
});

?>
