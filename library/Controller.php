<?php

/**
 * Controller
 */
class Controller
{
  protected $table;
  protected $database;

  public function __construct($table)
  {
    $this->table = $table;

    try {
      $this->database = new Medoo\Medoo([
        'database_type' => 'mysql',
        'database_name' => $_ENV['MYSQL_DATABASE'],
        'server' => $_ENV['MYSQL_HOST'],
        'username' => $_ENV['MYSQL_USERNAME'],
        'password' => $_ENV['MYSQL_PASSWORD']
      ]);
    } catch (\Exception $e) {
      die("There must be correct database connection settings the in the .env file.");
    }

  }

  public function printDatabaseError()
  {
    print_r($this->database->error());
  }

  public function post($data)
  {
    $this->database->insert($this->table, $data);
    return true;
  }

  public function all($fields)
  {
    return $this->database->select($this->table, $fields);
  }

  public function get($fields, $id)
  {
    return $this->database->select($this->table, $fields, ["id" => $id]);
  }

  public function put($data, $id)
  {
    $this->database->update($this->table, ["id" => $id]);
    return true;
  }

  public function delete($id)
  {
    $this->database->delete($this->table, ["id" => $id]);
    return true;
  }
}


?>
