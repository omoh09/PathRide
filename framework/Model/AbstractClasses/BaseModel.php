<?php

namespace Framework\Model\AbstractClasses;

use Framework\Database\Database;

abstract class BaseModel
{
  private $databaseInstance;

  protected $table;

  public function __construct($isFile = false)
  {
    if (!$isFile) {
      $this->databaseInstance = new Database();
    }
  }

  public function callGet()
  {
    return new \ArrayObject($this->callAll());
  }

  public function callAll()
  {
    $data = [];
    //$fromDataBase = $this->databaseInstance->query("SELECT * FROM todos");
    $fromDataBase = $this->databaseInstance->query("SELECT * FROM projects");
    $fromDataBase = $fromDataBase->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($fromDataBase as  $value) {
      $instance = new $this;
      foreach ($value as $key => $element) {
        $instance->$key = $element;
      }

      $data[] = $instance;
    }

    return $data;
  }

  public function findWithId($id)
  {
      //$query = $this->databaseInstance->query("SELECT * FROM todos WHERE id = :id");
      $query = $this->databaseInstance->query("SELECT * FROM projects WHERE id = :id");
      $query->bindParam(':id', $id, PDO::PARAM_INT);
      $query->execute();
      $data = $query->fetch(\PDO::FETCH_ASSOC);

      $instance = new $this;
      foreach ($data as $key => $element) {
          $instance->$key = $element;
      }
      return $instance;
  }

  public function save()
  {
    $handle = $this->databaseInstance->prepare('INSERT into projects (Id, title, description) VALUES (default, :title, :description)');
    $handle->bindParam(':title', $title, PDO::PARAM_STR);
    $handle->bindParam(':description', $description, PDO::PARAM_STR); 
    $handle->execute();

    $instance = new $this;
    foreach ($handle as $key => $element) {
        $instance->$key = $element;
    }
    return $instance;
  }

  public function update($id)
  {
    $handle = $this->databaseInstance->prepare('UPDATE projects SET (title "=" :title, description = :description) WHERE id = :id');
    $handle->bindParam(':title', $title, PDO::PARAM_STR);
    $handle->bindParam(':description', $description, PDO::PARAM_STR); 
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 
    $handle->bindParam(':id', $id, PDO::PARAM_INT);
    $handle->execute();

    $instance = new $this;
    foreach ($handle as $key => $element) {
        $instance->$key = $element;
    }
    return $instance;
  }

  public function delete($id)
  {
    $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $instance = new $this;
    foreach ($handle as $key => $element) {
        $instance->$key = $element;
    }
    return $instance;
  }

  public function getModelName()
  {
    return strtolower(__CLASS__);
  }

  protected function table()
  {
    return is_null($this->table) ? $this->getPlural($this->getModelName()) : $this->table;
  }

  protected function getPlural(string $string)
  {
    //@todo compute the plural of the string
    return $string;
  }
}

