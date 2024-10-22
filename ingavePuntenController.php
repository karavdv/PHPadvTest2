<?php 
//ingavePuntenController.php

declare(strict_types=1);

session_start();

require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Data\StudentenGegevens;
use App\Data\ModuleGegevens;

$loader = new FilesystemLoader('App/Presentation');
$twig = new Environment($loader);
$student = new StudentenGegevens();
$module = new ModuleGegevens();

if(isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
} else {
    $error = "";
}

$studentenLijst = "";
$moduleLijst = "";

try {
    $studentenLijst = $student->getStudentenLijst();
    $moduleLijst = $module->getModuleLijst();
} catch (Exception $e) {
    $error = "Er lijkt iets fout te lopen. Probeer het later opnieuw.";
}
echo $twig->render("ingavepunten.twig", array("error"=>$error,"studentenLijst"=>$studentenLijst, "moduleLijst"=>$moduleLijst));


?>