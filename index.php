<?php 
//index.php
declare(strict_types=1);
session_start();

require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader("App/Presentation");
$twig = new Environment($loader);

echo $twig->render("index.twig", array());

?>

