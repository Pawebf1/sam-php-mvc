<?php

declare(strict_types=1);

namespace Models;

class CargoFormValidate
{
    private int $cargoNumber;
    private array $POST;

    public function __construct(array $POST, int $cargoNumber)
    {
        $this->cargoNumber = $cargoNumber;
        $this->POST = $POST;
    }

    function popupAlert($message)
    {
        echo "<script>alert('$message');</script>";
    }

    function isWeekend($data)
    {
        return (date('N', strtotime($data)) >= 6);
    }

    function checkValidation(): bool
    {
        if ($this->isWeekend($this->POST['transportDate'])) {
            $this->popupAlert("Data transportu może odbywać się tylko w dni robocze");
            return false;
        }

        $x = 0;
        do {
            if ($this->POST["cargoWeight$x"] > $this->POST['inputGroupSelectAirplane']) {
                $this->popupAlert("Za duży cieżar w paczce nr " . $x + 1);
                return false;
            }
            $x++;
        } while ($x <= $this->cargoNumber);

        return true;
    }


}