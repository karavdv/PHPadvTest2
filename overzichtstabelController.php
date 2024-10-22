<?php 
//overzichtstabelController.php

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

$hoofdTabel= $tabel->getOverzichtstabel();
if (is_string($hoofdTabel)) {
    $error = $hoofdTabel;
}

$_SESSION["hoofdTabel"]=serialize($hoofdTabel);

echo $twig->render("overzichtstabel.twig", array("error"=>$error,"hoofdTabel"=>$hoofdTabel));


?>