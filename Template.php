<?php

/**
 * Grâce à cette classe j'inverse la mise en forme régulire des pages web en poussant le code voulu dans une page au lieu 
 * d'inclure pleins de pages (header,footer,menu(s),...). 
 *
 * @author Damien Chesneau <contact@damienchesneau.fr>
 */
include_once ("./Path.php");

class Template {

    private function getHeaderWithBootstrap() {
        print '<!doctype html>
<head>
    <title>Damien Chesneau - Etudiant en infomatique &amp; Développeur Java Java EE</title>
    <meta name="description" content="Site vitirine">
    <meta name="author" content="Damien Chesneau">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="language" content="fr" />
    <meta http-equiv="Content-Type" lang="fr" content="text/html; charset=UTF-8"></meta>
    <link rel="SHORTCUT ICON" href="' . Path::getAbsolute() . '/img/photo.jpg">
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/style.css">
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/box/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />    
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/box/source/jquery.fancybox.css?v=2.1.2" media="screen" /> 
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/bootstrap.min.css" media="screen" />   
</head>
<!--
    NE FAIS PAS DE COPIER COLLER !
    DO NOT COPY PASTE !
--> 
<body>
    <div id="main">';
    }

    private function getHeaderWithoutBootstrap() {
        print '<!doctype html>
<head>
    <title>Damien Chesneau - Etudiant en infomatique &amp; Développeur Java Java EE</title>
    <meta name="description" content="Site vitirine">
    <meta name="author" content="Damien Chesneau">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="language" content="fr" />
    <meta http-equiv="Content-Type" lang="fr" content="text/html; charset=UTF-8"></meta>
    <link rel="SHORTCUT ICON" href="' . Path::getAbsolute() . '/img/photo.jpg">
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/style.css">
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/box/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />    
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/box/source/jquery.fancybox.css?v=2.1.2" media="screen" />
    <link rel="stylesheet" type="text/css" href="' . Path::getAbsolutePathForCssFile() . '/normalise.css">
</head>
<!--
    NE FAIS PAS DE COPIER COLLER !
    DO NOT COPY PASTE !
--> 
<body>
    <div id="main">';
    }

    private function getFooter() {
        print '</div>
    <div id="map"></div>
    <div id="mapOverlay"></div>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCaeVQINq47j7V0gxi_jfv3fYxr96UbTY8&sensor=false"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolute() . '/webservices/load.php"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/modernizr.js"></script>       
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery.fancybox.js?v=2.1.3"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/fancyEffect.js"></script>        
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/modal.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/transition.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/me.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery.form.js"></script>
</body>
</html>';
    }

     private function getFooterForFistPage() {
        print '</div>
    <div id="map"></div>
    <div id="mapOverlay"></div>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCaeVQINq47j7V0gxi_jfv3fYxr96UbTY8&sensor=false"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolute() . '/webservices/load.php"></script>  
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery.fancybox.js?v=2.1.3"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/fancyEffect.js"></script>        
</body>
</html>';
    }
    private function getFooterForPortfolio() {
        print '</div>
    <div id="map"></div>
    <div id="mapOverlay"></div>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCaeVQINq47j7V0gxi_jfv3fYxr96UbTY8&sensor=false"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolute() . '/webservices/load.php"></script>  
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery.fancybox.js?v=2.1.3"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/fancyEffect.js"></script>        
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/modal.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/transition.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/me.js"></script>
</body>
</html>';
    }
     private function getFooterForGestion() {
           print '</div>
    <div id="map"></div>
    <div id="mapOverlay"></div>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCaeVQINq47j7V0gxi_jfv3fYxr96UbTY8&sensor=false"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolute() . '/webservices/load.php"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/modernizr.js"></script>       
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery-1.8.2.min.js"></script>  
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/modal.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/transition.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/me.js"></script>
    <script type="text/javascript" src="' . Path::getAbsolutePathForJavascriptFile() . '/jquery.form.js"></script>
</body>
</html>';
    }
     public function setAGestionPageToShow($page){
        $this->getHeaderWithBootstrap();
        $tabfich = file($page);
        for ($i = 0; $i < count($tabfich); $i++) {
            print $tabfich[$i];
        }
        $this->getFooterForGestion();
    }
    public function setAPortfolioPageToShow($page){
        $this->getHeaderWithBootstrap();
        $tabfich = file($page);
        for ($i = 0; $i < count($tabfich); $i++) {
            print $tabfich[$i];
        }
        $this->getFooterForPortfolio();
    }

    public function setHtmlPageToShow($page) {
        $this->getHeaderWithoutBootstrap();
        $tabfich = file($page);
        for ($i = 0; $i < count($tabfich); $i++) {
            print $tabfich[$i];
        }
        $this->getFooter();
    }
    public function setFirstPage($page) {
        $this->getHeaderWithoutBootstrap();
        $tabfich = file($page);
        for ($i = 0; $i < count($tabfich); $i++) {
            print $tabfich[$i];
        }
        $this->getFooterForFistPage();
    }
    public function setHtmlPageToShowWithBootstrap($page) {

        $this->getHeaderWithBootstrap();
        $tabfich = file($page);
        for ($i = 0; $i < count($tabfich); $i++) {
            print $tabfich[$i];
        }
        $this->getFooter();
    }

    public function setContent($content) {
        echo $content;
    }

}
