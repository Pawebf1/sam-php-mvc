<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Models\Database;

class HomeController
{
    public function index(): View
    {
        return View::make('index/index', ['foo' => 'bar']);
    }

    public function cos(): View
    {
        $db = new Database;
        return View::make('index', ['foo' => 'bar']);
    }

}