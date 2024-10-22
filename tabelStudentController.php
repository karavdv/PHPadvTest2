<?php 
//tabelStudentController.php

declare(strict_types=1);

session_start();

require_once("vendor/autoload.php");


use App\Business\Tabellen;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('App/Presentation');
$twig = new Environment($loader);
$tabel = new Tabellen();

$error ="";


if(isset($_GET["student"])) {
    $studentId= (int) $_GET["student"];  
    $gezochteStudent= $tabel->getStudentTabel($studentId);
    if(empty($gezochteStudent)){
        $error= "Er is een fout opgetreden. Probeer opnieuw.";
    }
    
    
} else {
    $error= "Er is een fout opgetreden. Probeer opnieuw.";
}


echo $twig->render("tabelStudent.twig", array("error"=>$error,"gezochteStudent"=>$gezochteStudent));



?>