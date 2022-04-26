<?php

namespace Framework\Database;

class Database extends Connection
{
  public function __construct()
  {
    // from .env
    //parent::__construct('mysql', 'localhost', 'kodecamp_php', 'root', '1111');
    parent::__construct('mysql', 'localhost', 'leo-App', 'admin', 'admin');
  }

  public function getInstance()
  {
    return $this;
  }
}
