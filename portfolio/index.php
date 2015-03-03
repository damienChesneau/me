<?php
include_once '../Template.php'; 
include_once ("../Path.php");
$page = new Template();
$path = Path::getAbsolute();
$page->setAPortfolioPageToShow($path."/portfolio/content.php");