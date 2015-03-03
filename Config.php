<?php
/**
 * Description of Config
 *
 * @author damien 
 */
class Config {

    const PROD = "prod";

    const DEV = "dev";
    
    public static function getType() {
        return Config::PROD;
    }

}
