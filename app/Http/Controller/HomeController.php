<?php

namespace App\Http\Controller;

use App\Models\User;

class HomeController
{
    public function index()
    {
        $user = new User();

        foreach (User::get() as $user) {
            die(var_dump($user));
        }

        die(var_dump(User::get()));

        return <<<HTML
  <h1>Index</h1>
    <p>Controller Page Test</p>
HTML;
    }
}
