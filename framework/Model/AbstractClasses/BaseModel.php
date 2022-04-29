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
    $fromDataBase = $this->databaseInstance->query("SELECT * FROM todos");
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
      $query = $this->databaseInstance->query("SELECT * FROM todos WHERE id = :id");
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
    //save to the instance
  }

  public function update($id)
  {
    //
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

