<?php

include_once "./library/Controller.php";

/**
 * DatabaseController
 */
class DatabaseController extends Controller
{
  public function __construct()
  {
    parent::__construct("");
  }

  public function createTable($tableName)
  {
    $this->database->create($tableName, [
      "id" => [
    		"INT",
    		"NOT NULL",
    		"AUTO_INCREMENT",
    		"PRIMARY KEY"
    	],
    	"created" => [
    		"DATATIME",
    		"DEFAULT NOW()"
    	],
    	"updated" => [
    		"DATATIME",
    		"DEFAULT NOW()",
        "ON UPDATE NOW()"
    	]
    ]);

    return true;
  }

  public function createColumn($tableName, $columnName, $columnType)
  {
    $this->database->query("ALTER TABLE $tableName ADD $columnName $columnType;");

    return true;
  }

  public function updateColumn($tableName, $columnName, $columnType)
  {
    $this->database->query("ALTER TABLE $tableName MODIFY COLUMN $columnName $columnType;");

    return true;
  }

  public function deleteColumn($tableName, $columnName)
  {
    $this->database->query("ALTER TABLE $tableName DROP $columnName;");

    return true;
  }
}


?>
