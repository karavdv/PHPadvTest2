<?php 
//controleIngavePuntenController.php

declare(strict_types=1);
session_start();

require_once("vendor/autoload.php");

use App\Business\ControllerValidatie;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('App/Presentation');
$twig = new Environment($loader);
$controle = new ControllerValidatie();

$studentenId = "";
$moduleId = "";
$score = "";


if (isset($_POST["btnResultaat"])) {
    unset($_SESSION["error"]);
    $studentenId = (int) $_POST ["student"];
    $moduleId = (int) $_POST ["module"];
    $score = (float) $_POST ["punten"];
 
}    

if($controle ->ingaveFormulierCheck($studentenId, $moduleId, $score)) {

    echo $twig->render("ingavegeslaagd.twig", array());
    if(isset($_SESSION["hoofdTabel"])){
        unset($_SESSION["hoofdTabel"]);
    }

    } else {
            $_SESSION["error"]= "Er liep iets fout. Probeer het later opnieuw.";
            header('location: ingavePuntenController.php');
            exit;
        };

?>