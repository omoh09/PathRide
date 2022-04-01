<?php
namespace App\Http\Controller;

class HomeController
{
    public function index() {

        return <<<HTML
  <h1>Index</h1>
    <p>Controller Page Test</p>
HTML;
    }
}