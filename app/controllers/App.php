<?php

namespace App;

use Sober\Controller\Controller;

class App extends Controller
{
    public static function siteName()
    {
        return get_bloginfo('name');
    }
}
