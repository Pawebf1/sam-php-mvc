<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Models\Database;
use Models\CargoFormValidate;

class HomeController
{
    public function createDictionary(): array
    {
        return ['cargoNumber' => $_GET['cargo_number'] ?? 1,
            'today' => date('Y-m-d')];
    }

    public function index(): View
    {
        return View::make('home/index', $this->createDictionary());
    }

    public function send(): View
    {
        $packageFormValidate = new CargoFormValidate($_POST, $_GET['cargo_number'] ?? 1);
        if (!$packageFormValidate->checkValidation())
            return View::make('home/index', $this->createDictionary());
        
        return View::make('home/send', $this->createDictionary());
    }

}