<?php

namespace Ernio\Bankas\Controllers;

use Ernio\Bankas\App;


class HomeController
{
    public function home()
    {
        return App::view('home');
    }
}