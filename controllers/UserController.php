<?php

include_once "./library/Controller.php";

/**
 * UserController
 */
class UserController extends Controller
{
  public function __construct($table)
  {
    parent::__construct($table);
  }

  public function create()
  {
    $this->database->create($this->table, [
      "id" => [
    		"INT",
    		"NOT NULL",
    		"AUTO_INCREMENT",
    		"PRIMARY KEY"
    	],
    	"first_name" => [
    		"VARCHAR(250)"
    	],
    	"last_name" => [
    		"VARCHAR(250)"
    	],
    	"username" => [
    		"VARCHAR(250)"
    	],
    	"password" => [
    		"VARCHAR(250)"
    	],
    	"created" => [
    		"DATETIME",
    		"DEFAULT NOW()"
    	],
    	"updated" => [
    		"DATETIME",
    		"DEFAULT NOW()",
        "ON UPDATE NOW()"
    	]
    ]);
  }

  public function isUserUnique($data)
  {
    $users = $this->database->select($this->table, ["username"], ["username" => $data["username"]]);

    return count($users) === 0;
  }
}


?>
