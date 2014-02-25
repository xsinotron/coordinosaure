<?php
/**
 * DB : classe à instancier pour appeler la base de donnée paramètrée.
 * @param {String} $user
 * @param {String} $pass
 * @param {String} $dir
 * @param {String} $db
 */
class Bdd {
    protected
    $user,
    $pass,
    $dir,
    $table,
    $bdd;
    protected
    function connect() {
        $noError = TRUE;
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $bdd = new PDO("mysql:host=".$this->dir.";dbname=".$this->table, $this->user, $this->pass, $options);
        } catch (Exception $e) {
            echo "Connection à MySQL impossible : ", $e->getMessage();
            die();
            return FALSE;
        }
        return $bdd;
    }
    protected
    function query($sqlQuery) {
        $bdd = $this->connect();
        if ($bdd != FALSE) {
            $pdo      = $bdd->query($sqlQuery);
            $callback = $pdo->fetch(PDO::FETCH_OBJ);
            return $callback;
        } else {
            return FALSE;
        }
    }
    protected
    function queryAll($sqlQuery) {
        $bdd = $this->connect();
        if ($bdd != FALSE) {
            $pdo      = $bdd->query($sqlQuery);
            $callback = $pdo->fetchAll(PDO::FETCH_OBJ);
            return $callback;
        } else {
            return FALSE;
        }
    }
    protected
    function queryBool($sqlQuery) {
        $bdd = $this->connect();
        //print_r($sqlQuery);
        if ($bdd != FALSE) {
            $pdo      = $bdd->prepare($sqlQuery);
            $callback = $pdo->execute();
            return $callback;
        } else {
            return FALSE;
        }
    }
    // CONSTRUCT
    public function __construct($user, $pass, $dir, $table) {
        $this->user  = $user;
        $this->pass  = $pass;
        $this->dir   = $dir;
        $this->table = $table;
    }
    // PUBLIC
    /**
     * Récupère les données reçus par une requête SQL.
     * @param {string} $sqlQuery est une requête SQL au format texte.
     * @return {Array OR BOOLEAN}
     */
    public
    function req($sqlQuery, $type=0){
        if ($type == 0) {
            $return = 'boolean';
            $data = $this->queryBool($sqlQuery);
        } else if ($type == 1) {
            $return = 'list';
            $data = $this->query($sqlQuery);
        } else {
            $return = 'array';
            $data = $this->queryAll($sqlQuery);
        }
        return $data;
    }
    public
    function getAmapiensList () {
        return $this->req("SELECT * FROM `amapiens`;", 1);
    }
    public
    function getContratsList () {
        return $this->req("SELECT * FROM `contrats`;");
    }
}
?>
