<?php

namespace App\Http\Controller;

use App\Models\User;

class HomeController
{
    public function index()
    {
        $user = new User();

        die(var_dump($user->all()));

        return <<<HTML
  <h1>Index</h1>
    <p>Controller Page Test</p>
HTML;
    }
}
