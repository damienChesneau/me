<?php
session_start();
if ($_SESSION['idGestion'] != "") {
    if ($_SESSION['idGestion'] != "PASOK") {
        
    } else {
        header("Status : 404 Not Found");
        header('HTTP/1.0 404 Not Found');
        exit();
    }
} else {
    header("Status : 404 Not Found");
    header('HTTP/1.0 404 Not Found');
    exit();
}
?>