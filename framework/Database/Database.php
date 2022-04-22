<?php

namespace Framework\Database;

class Database extends Connection
{
  public function __construct()
  {
    // from .env
    parent::__construct('mysql', 'localhost', 'kodecamp_php', 'root', '1111');
  }

  public function getInstance()
  {
    return $this;
  }
}
