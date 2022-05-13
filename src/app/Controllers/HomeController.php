<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Models\Database;
use Models\CargoFormValidate;
use Models\Mailer;

class HomeController
{

    public function createDictionary(): array
    {
        if (isset($_GET['cargo_number']))
            $cargoNumber = (int)$_GET['cargo_number'];
        else
            $cargoNumber = 1;

        return ['cargoNumber' => $cargoNumber,
            'today' => date('Y-m-d')];
    }

    public function index(): View
    {
        return View::make('home/index', $this->createDictionary());
    }

    public function send(): View
    {
        if (isset($_GET['cargo_number']))
            $cargoNumber = (int)$_GET['cargo_number'];
        else
            $cargoNumber = 1;

        $packageFormValidate = new CargoFormValidate($_POST, $cargoNumber);

        if (!$packageFormValidate->checkValidation())
            return View::make('home/index', $this->createDictionary());


        $mail = new Mailer($cargoNumber, $_POST, $_FILES);
        //$mail->send();

        $db = new Database();
        return View::make('home/send', $this->createDictionary());
    }

}