<?php

declare(strict_types=1);


namespace Models;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    private int $cargoNumber;
    private PHPMailer $mail;
    private array $POST;
    private array $FILES;

    public function __construct(int $cargoNumber, array $POST, array $FILES)
    {
        $this->POST = $POST;
        $this->FILES = $FILES;
        $this->cargoNumber = $cargoNumber;

        if ($this->POST['inputGroupSelectAirplane'] == '35000')
            $to = $_ENV['MAIL_AIRBUS'];
        else
            $to = $_ENV['MAIL_BOEING'];

        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $_ENV['MAIL_PORT'];
        $this->mail->Username = $_ENV['MAIL_USERNAME'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
        $this->mail->isHTML(true);
        $this->mail->setFrom("transport@samoloty.com", "Pawel");
        $this->mail->addAddress($to);
        $this->mail->Subject = ("Transport");
    }

    public function htmlBody(): string
    {
        $body = "<table> ";
        $body .= " <tr> <th> Transport z </th> <th>" . $this->POST['transportFrom'] . "</th></tr>";
        $body .= " <tr> <th> Transport do </th> <th>" . $this->POST['transportTo'] . "</th></tr>";
        $body .= " <tr> <th> Data transportu </th> <th>" . $this->POST['transportDate'] . "</th></tr>";

        $x = 0;
        do {
            $body .= " <tr> <th> Ladunek nr </th> <th>" . $x + 1 . "</th></tr>";
            $body .= " <tr> <th> Nazwa ladunku </th> <th>" . $this->POST["cargoName$x"] . "</th></tr>";
            $body .= " <tr> <th> Ciezar ladunku </th> <th>" . $this->POST["cargoWeight$x"] . "</th></tr>";
            $body .= " <tr> <th> Typ ladunku </th> <th>" . $this->POST["cargoType$x"] . "</th></tr>";
            $x++;
        } while ($x < $this->cargoNumber);
        $body .= "</table>";

        return $body;
    }

    public function rawTextBody(): string
    {
        $body = "Transport z " . $this->POST['transportFrom'];
        $body .= ". Transport do " . $this->POST['transportTo'];
        $body .= ". Data transportu " . $this->POST['transportDate'];

        $x = 0;
        do {
            $body .= ". Ladunek nr " . $x + 1;
            $body .= ". Nazwa ladunku " . $this->POST["cargoName$x"];
            $body .= ". Ciezar ladunku " . $this->POST["cargoWeight$x"];
            $body .= ". Typ ladunku " . $this->POST["cargoType$x"];
            $x++;
        } while ($x < $this->cargoNumber);

        return $body;
    }

    public function addAttachment(): void
    {
        for ($i = 0; $i < count($this->FILES['documents']['tmp_name']); $i++)
            $this->mail->addAttachment($this->FILES['documents']['tmp_name'][$i], $this->FILES['documents']['name'][$i]);
    }


    public function prepareMail(): void
    {
        $this->mail->Body = $this->htmlBody();
        $this->mail->AltBody = $this->rawTextBody();
        $this->addAttachment();
    }

    public function send(): void
    {
        try {
            $this->prepareMail();
            $this->mail->send();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}