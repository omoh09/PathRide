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
      // die(var_dump($this->databaseInstance));
    }
  }

  public function get()
  {
    // return iterateable or models instances
  }

  public function all()
  {
    $data = [];
    // die(var_dump("SELECT * FROM {$this->table()}"));
    // die(var_dump($this));
    $fromDataBase = $this->databaseInstance->query("SELECT * FROM {$this->table()}");
    $fromDataBase = $fromDataBase->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($fromDataBase as  $value) {
      $instance = new $this;
      // $instance->test = 1;
      // die(var_dump($instance));
      foreach ($value as $key => $element) {
        $instance->$key = $element;
      }

      $data[] = $instance;
    }

    return $data;
  }

  public function find($id)
  {
    // returns a single instance of this
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
