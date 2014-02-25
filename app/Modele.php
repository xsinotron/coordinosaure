<?php
    require dirname(__FILE__).'/vendor/Mustache/Autoloader.php';
    Mustache_Autoloader::register();
    require('DataTest.php');
    require('Bdd.php');
/**
 * Classe de Control
 */
class Modele {
    private
    $debug = 0,
    $session,
    $DB,
    $user;
    public
    $m,
    $mustache;
    // SESSION CREATE
    protected
    function createSession () {
        $this->session = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz,;:/?!", 5)), 0, 5);
        $_SESSION['token'] = $this->session;
    }
    /**
     * Test si c'est un string de moins de 32 caractères
     * @param {String} $name
     * @param {Integer} $length
     * @return {Boolean}
     */
    protected
    function testString ($name=NULL, $length=NULL) {
        if ($name === NULL || $length === NULL) {return false; }
        if (gettype($name) === 'string') {
            if (strlen($name) > 32) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
        
    }
    protected
    function insertData ($data=array(), $table='') {
        $i = 0;
        $lengthData = count($data) - 1;
        $params = '';
        $values = '';
        $request = "INSERT INTO " . $table;
        //print_r($data);
        foreach($data as $key => $val) {
            if ($val !== null && $val !== '') {
                $params .= $key;
                $values .= "'" . $val. "'";
                if ($i != $lengthData) {
                    $params .= ', ';
                    $values .= ', ';
                }
            }
            $i++;
        }
        $request .= " (" . $params . ") VALUES (".$values.");";
        $result = $this->DB->req($request, 0);
        return $result;
    }
    protected
    function updateData ($id='', $data=array(), $table='') {
        $i = 0;
        $lengthData = count($data);
        $params = '';
        $values = '';
        $request = "UPDATE INTO " . $table;
        foreach($data as $key => $val) {
            $params .= $key;
            $values .= "'" . $val. "'";
            if (($i - 1) != $lengthData) {
                $params .= ', ';
                $values .= ', ';
            }
            $i++;
        }
        
        $request .= " (" . $params . ") VALUES (".$values.") WHERE id=" . $id . ";";
        $result = $this->DB->req($request, 0);
        return $result;
    }
    protected
    function deleteEntry ($id, $table) {
        $request .= " DELETE INTO " . $table . " WHERE id='".$id."';";
        $result = $this->DB->req($request, 0);
        return $result;
    }
    protected
    function getList ($from='') {
        return $this->DB->req("SELECT * FROM `" . $from . "`;", 2);
    }
    protected
    function createTables() {
        $tables = array(
            "amapiens" =>
               "id       INT UNSIGNED auto_increment,
                name     VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                surname  VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                address  VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci,
                zipcode  VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_general_ci,
                city     VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                email1   VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                email2   VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                email3   VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                phone    VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
                arrived  DATE,
                updated  BOOLEAN,
                active   BOOLEAN,
                infos    VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (id)",
            "producteurs" =>
               "id       INT UNSIGNED auto_increment,
                name     VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                surname  VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                email    VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                address  VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci,
                zipcode  VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_general_ci,
                city     VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                phone    VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
                infos    VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (id)",
            "contrats_type" =>
               "id            INT UNSIGNED auto_increment,
                name          VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                producteur_id INT,
                debut         DATE,
                fin           DATE,
                PRIMARY KEY (id)",
            "produits_type" =>
               "id            INT UNSIGNED auto_increment,
                name          VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci,
                contrat_id    INT NOT NULL,
                prix_unitaire FLOAT NOT NULL,
                PRIMARY KEY (id)",
            "contrats" =>
               "id         INT UNSIGNED auto_increment,
                amapien_id INT,
                type_id    INT,
                debut      DATE,
                infos      VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (id)",
            "produits" =>
               "id         INT UNSIGNED auto_increment,
                amapien_id INT NOT NULL,
                distrib_id INT NOT NULL,
                type_id    INT NOT NULL,
                nb         FLOAT NOT NULL,
                infos      VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (id)",
            "lieux" =>
               "id       INT UNSIGNED auto_increment,
                name    VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci,
                address VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci,
                zipcode VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_general_ci,
                city    VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                phone   VARCHAR(14) CHARACTER SET utf8 COLLATE utf8_general_ci,
                debut   TIME,
                fin     TIME,
                infos   VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (id)",
            // une distribution est définie pour un contrat donné. 
            "distributions" =>
               "id         INT UNSIGNED auto_increment,
                lieux_id   INT,
                contrat_id INT,
                date       DATE,
                debut      TIME,
                fin        TIME,
                infos      VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (id)",
            "pauses" =>
               "id         INT UNSIGNED auto_increment,
                contrat_id INT, date DATE,
                infos      VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci,
                PRIMARY KEY (id)",
            "coordination" =>
               "id         INT UNSIGNED auto_increment,
                amapien_id INT,
                contrat_id VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                email      VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
                debut      DATE,
                fin        DATE,
                PRIMARY KEY (id)",
            "paiements" =>
               "id         INT UNSIGNED auto_increment,
                amapien_id INT NOT NULL,
                contrat_id INT NOT NULL,
                somme      DOUBLE NOT NULL,
                mode       VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'chèque' NOT NULL,
                paye       BIT DEFAULT 0,
                PRIMARY KEY (id)"
        );
        $request = '';
        foreach($tables as $table => $fields) {
            $req .= "CREATE TABLE " . $table . " (\n" . $fields . ");\n";
            $callback = $this->DB->req($req, 0);
            if ($callback == FALSE) return $callback;
        }
        return $request;
      //return $this->DB->req($request);
    }
    protected function db_delete() {
        $req = "DROP TABLE `amapiens`, `contrats`, `contrats_type`, `coordination`, `distributions`, `lieux`, `paiements`, `pauses`, `producteurs`, `produits`, `produits_type`";
        return $this->DB->req($req, 0);
    }
    // PUBLIC
    /**
     * @return {String} connexion
     */
    public
    function getSession () {
    	if (isset($this->session)) $this->createSession();
        return $this->session;
    }
    public
    function getMainMenu () {
        return $this;
    }
    public
    function install() {
        if ($this->user->group == "SuperAdmin") {
            return $this->createTables();
        }
    }
    public
    function delete() {
        if ($this->user->group == "SuperAdmin") {
            $this->db_delete();
        }
    }
    public
    function getContrats () {
        return $this->getList('contrats_type');
    }
    public
    function getAmapiens () {
        return $this->getList('amapiens');
    }
    public
    function getAmapien ($who) {
        return current($this->DB->req("SELECT * FROM `amapiens` WHERE id=".$who.";", 2));
    }
    public
    function getProduits () {
        return $this->getList('produits');
    }
    public
    function getProducteurs () {
        return $this->getList('producteurs');
    }
    public
    // PRODUITS
    function deleteProduit($id='') {
        return $this->deleteEntry($id, 'produits');
    }
    public
    function editProduit($id='', $params=array()) {
        return $this->updateData($id, $params, 'produits');
    }
    public
    function insertProduit($params=array()) {
        return $this->insertData($params, 'produits');
    }
    // PRODUCTEUR
    public
    function deleteProducteur ($id='') {
        return $this->deleteEntry($id, 'producteurs');
    }
    public
    function editProducteur ($id='', $params=array()) {
        return $this->updateData($id, $params, 'producteurs');
    }
    public
    function insertProducteur ($params=array()) {
        return $this->insertData($params, 'producteurs');
    }
    // CONTRAT
    public
    function deleteContrat ($id=''){
        return $this->deleteEntry($id, 'contrats');
    }
    public
    function editContrat ($id='', $params) {
        return $this->updateData($id, $params, 'contrats');
    }
    // CONTRAT TYPE
    public
    function deleteContratType ($id=''){
        return $this->deleteEntry($id, 'contrats_type');
    }
    public
    function editContratType ($id='', $params) {
        return $this->updateData($id, $params, 'contrats_type');
    }
    public
    function insertContratType ($params) {
        return $this->insertData($params, 'contrats_type');
    }
    /**
     * Méthode de modification d'un contrat :
     * On test d'abord si les contenus sont valides
     */
    public
    function insertContrat ($params=array()) {
        return $this->insertData($params, 'contrats');
    }
    public
    function deleteAmapien ($id='') {
        return $this->deleteEntry($id, 'amapiens');
    }
    public
    function editAmapien ($params=array()) {
        return $this->updateData($id, $params, 'amapiens');
    }
    /**
     * Amapiens : id    name surname  email1  address phone arrived updated   infos   email2  email3
     */
    public
    function insertAmapien($amapien=array() ) {
        $data = array();
        $params = '';
        $values = '';
        $isMin = FALSE; // test si on a un minimum d'infos fournis
        $isMinContact = FALSE; // test si on a au moins un contact d'enregistré
        $test = new DataTest();
        $result_test = $test->amapien($amapien);
        if (!$result_test['success']) {
            return $result_test;
        }
        // si les tests sont bons c'est partis!
        if (isset($amapien['phone'])) {
            $isMinContact = TRUE;
        }
        if (isset($amapien['email1']))  {
            $isMinContact = TRUE;
        }
        if (isset($amapien['email2']))  {
            $isMinContact = TRUE;
        }
        if (isset($amapien['email3']))  {
            $isMinContact = TRUE;
        }
        if ($isMinContact || (isset($data['name']) && isset($data['surname']))) {
            $isMin = TRUE;
        } else {
            return json_encode(array(
                "success" => FALSE,
                "infos"   => "pas de contenu minimum"
            ));
        }
        if ($isMin) $result_query = $this->insertData($amapien, 'amapiens');
        if ($result_query != FALSE) {
            return json_encode(array(
                "success" => TRUE,
                "infos"   => $result_query
            ));
        } else {
            return json_encode(array(
                "success" => $result_query,
                "infos"   => "données manquantes"
            ));
        }
    }
    public
    function gen($tpl,$data) {
        $this->m = $this->mustache = new Mustache_Engine;
        return $this->m->render(file_get_contents($tpl), $data);
    }
    public
    function setIdentification () {
        // TODO
    }
    // CONSTRUCT
    public
    function __construct($sqlUser, $sqlPass,$sqlDir, $database) {
        $this->sqlUser  = $sqlUser;
        $this->sqlPass  = $sqlPass;
        $this->sqlDir   = $sqlDir;
        $this->database = $database;
        $DB = new Bdd(
            $this->sqlUser,
            $this->sqlPass,
            $this->sqlDir,
            $this->database
        );
        //echo $this->debug;
        if ($this->debug == 0) {
            $this->user = new StdClass();
            $this->user->group = "SuperAdmin";
            //echo $this->user->group;
        } else {
            // TODO gestion des droits utilisateurs
        }
        $this->DB = $DB;
        $this->createSession();
        //$this->m = $this->mustache = new Mustache_Engine;
        //echo $this->m->render('Hello {{planet}}', array('planet' => 'World!')); // "Hello World!"
    }
}
?>
