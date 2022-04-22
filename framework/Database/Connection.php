<?php

namespace Framework\Database;

use Exception;
use phpDocumentor\Reflection\Types\Boolean;

class Connection extends \PDO
{
  // private $dbHostName;
  // private $dbHostServer;
  // private $bdName;
  // private $username;
  // private $password;
  // private $isFile;

  public function __construct(
    string $dbHostName,
    string $dbHostServer,
    string $bdName,
    string $username,
    string $password,
    $isFile = false
  ) {

    if (!$isFile) {
      try {
        // die("{$dbHostName}:host={$dbHostServer}; dbname={$bdName}");
        parent::__construct("{$dbHostName}:host={$dbHostServer}; dbname={$bdName}", $username, $password);
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // die(var_dump($this->exec("INSERT INTO todos (title) VALUES('Test here')")));
        // $this->setAttribute(\PDO::ATTR_STATEMENT_CLASS, array('DBStatement', array($this)));
      } catch (\PDOException $e) {
        //log error later
        throw new Exception($e->getMessage());
      }
    }
  }
}
