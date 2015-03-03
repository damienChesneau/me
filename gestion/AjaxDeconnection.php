<?php
session_start();
$_SESSION['idGestion'] = "";
session_unset ();
session_destroy ();