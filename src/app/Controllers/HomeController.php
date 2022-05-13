<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Models\Database;

class HomeController
{
    public function index(): View
    {
        $packageNumber = $_GET['number_of_packages'] ?? 1;

        $dictionary = ['packageNumber' => $packageNumber,
            'today' => date('Y-m-d')];
        return View::make('home/index', $dictionary);
    }

    public function send(): View
    {
        return View::make('home/send',);
    }

}