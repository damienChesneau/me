<?php
include_once '../Template.php';
include_once ("../Path.php");
$page = new Template();
$pageDeConnection = Path::getAbsolute() . "/gestion/connection.php";
$pageDeGestion = Path::getAbsolute() . "/gestion/content.php";
session_start();
if ($_SESSION['idGestion'] != "") {
    if($_SESSION['idGestion'] != "PASOK"){
        $page->setAGestionPageToShow($pageDeGestion);
    }else{
        $page->setAGestionPageToShow($pageDeConnection);
    }
} else {
    $page->setAGestionPageToShow($pageDeConnection);
}
