<?php

include '../Config.php';

/**
 * Description of ConnexionBDD
 *
 * @author Damien Chesneau <contact@damienchesneau.fr>
 */
class ConnexionBDD {

    private $USER = "dbo473075695";
    private $PASSWORD = "chesneau";
    private $SERVERNAME = "db473075695.db.1and1.com";
    private $DATABASE = "db473075695";
    private $bdd;
    private $type = array('prod', 'dev');

    private function getConfiguration() {
        // 0 type ; 1 USER ; 2 PASSWORD ; 3 SERVERNAME ; 4 DATABASE ;
        $config = array();
        $config[0] = array($type[1], 'dbo473075695', 'chesneau', 'db473075695.db.1and1.com', 'db473075695');
        $config[1] = array($type[0], 'root', 'damien', 'localhost', 'db473075695');
        if(\Config::getType() == \Config::DEV){
            return $config[1];
        }else if (\Config::getType() == \Config::PROD) {
            return $config[0];
        }
        echo 'error';
    }

    private function getUser() {
        $configuration = $this->getConfiguration();
        return $configuration[1];
    }

    private function getPassword() {
        $configuration = $this->getConfiguration();
        return $configuration[2];
    }

    private function getServeurName() {
        $configuration = $this->getConfiguration();
        return $configuration[3];
    }

    private function getDataBase() {
        $configuration = $this->getConfiguration();
        return $configuration[4];
    }

    private function getTrame() {
        $requete = 'mysql:host=' . $this->getServeurName() . ';dbname=' . $this->getDataBase();
        return $requete;
    }

    public function __construct() {
        try {
            $pdo_option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $pdo_option[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
            $this->bdd = new PDO($this->getTrame(), $this->getUser(), $this->getPassword(), $pdo_option);
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
            die('Erreur :' . $e->getTrace());
            die('Erreur :' . $e->getCode());
        }
    }
    /*
     * Method like INSERT 
     */
    public function exec($query) {
        try {// echo '<pre style="border:1px solid red;height:25%">' . $query . '<br /></pre>';
            $this->bdd->exec($query);
            $this->bdd->lastInsertId();
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
            die('Erreur :' . $e->getTrace());
            die('Erreur :' . $e->getCode());
        }
    }
    public function execWithId($query) {
        try {// echo '<pre style="border:1px solid red;height:25%">' . $query . '<br /></pre>';
            $this->bdd->exec($query);
            return $this->bdd->lastInsertId();
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
            die('Erreur :' . $e->getTrace());
            die('Erreur :' . $e->getCode());
        }
    }

    /*
     * Method like UPDATE DELETE SELECT
     */

    public function query($query) {
        try {
            $result = $this->bdd->query($query);
            $result->setFetchMode(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
            die('Erreur :' . $e->getTrace());
            die('Erreur :' . $e->getCode());
        }
        // echo '<pre style="border:1px solid red;height:25%">' . $query . '<br />' . print_r($result) . '</pre>';
        return $result;
    }

    public function closeConnexion() {
        $this->bdd = null;
    }

    public function getInTab($query) {
        try {
            $result = $this->bdd->query($query);
        } catch (Exception $exc) {
            die('Erreur :' . $e->getMessage());
            die('Erreur :' . $e->getTrace());
            die('Erreur :' . $e->getCode());
        }return $result;
    }

}

?>
