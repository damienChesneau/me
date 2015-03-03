<?php

include_once '../Config.php';
/**
 * Description of Path
 *
 * @author damien
 */
class Path {

    public static function getAbsolute() {
        $ret = "";
        if (Config::getType() == Config::DEV) {
            $ret = "http://localhost/WebDynamiqueProjet";
        } else if (Config::getType() == Config::PROD) {
            $ret = "http://damienchesneau.fr";
        }
        return $ret;
    }
    public static function getAbsolutePathForJavascriptFile() {
        $ret = "";
        if (Config::getType() == Config::DEV) {
            $ret = Path::getAbsolute()."/js/dev";
        } else if (Config::getType() == Config::PROD) {
            $ret = Path::getAbsolute()."/js/prod";
        }
        return $ret;
    }
    public static function getAbsolutePathForCssFile() {
        $ret = "";
        if (Config::getType() == Config::DEV) {
            $ret = Path::getAbsolute()."/css/dev";
        } else if (Config::getType() == Config::PROD) {
            $ret = Path::getAbsolute()."/css/prod";
        }
        return $ret;
    }

}
