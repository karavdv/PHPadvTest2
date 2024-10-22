<?php 
//tabelModuleController.php

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
$gezochteModule = [];

if(isset($_GET["module"])) {
    $moduleId= (int) $_GET["module"];  
    $gezochteModule= $tabel->getModuleTabel($moduleId);
    
    if(empty($gezochteModule)){
        $error= "Er is een fout opgetreden. Probeer opnieuw.";
    }
    

} else {
    $error= "Er is een fout opgetreden. Probeer opnieuw.";
}


echo $twig->render("tabelModule.twig", array("error"=>$error,"gezochteModule"=>$gezochteModule));



?>