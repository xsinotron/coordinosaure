<?php
/**
 * Test des formulaires
 * -- Amapiens : id    name    surname    email1    address    phone    arrived    updated    infos    email2    email3
 * CREATE TABLE amapiens (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, name VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '', surname VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL default '', address VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci, email1 VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci, email2 VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci, email3 VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci, phone VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_general_ci, arrived DATE, updated BOOLEAN, infos VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci);
 *
 * 
 * TODO tester les insertions de javascript et serrer la vis sur chacune des entrées.
 */
Class DataTest {
    protected
    $isCritical = FALSE;
    /**
     * Test de formatage d'un numéro de téléphone
     */
    protected
    function isMail ($email=NULL) {
        if ($email == NULL) return FALSE;
    }
    /**
     * Test de formatage d'un email
     */
    protected
    function isphone ($phone=NULL) {
        if ($phone == NULL) return FALSE;
        // TODO : REGEXP [0-9+]
        $test = preg_match('/[0-9+]*/', $phone);
        $currLength = strlen($phone);
        if ($currLength <= 0) {
            $errors['phone'] = 'champs vide';
        } else if ($currLength > 15) {
            $isCritical = TRUE;
            $errors['phone'] = 'Ce name est trop long.';
        }
    }
    /**
     * Test de formatage d'une date
     */
    protected
    function dateTest ($date=NULL) {
        if ($email == NULL) return FALSE;
        // TODO règles de test d'une date
    }
    /**
     * Test d'un champ texte :
     * TODO suppression des insertions de js et sql
     * @param {string} char : texte à tester.
     * @param {number} max : namebre de charactères maximum.
     * @param {boolean} empty : autorise un contenu vide.
     * @return {boolean}
     */
    protected
    function isChar ($char, $max=NULL, $empty=TRUE) {
        $currLength = strlen($char);
        if ($currLength <= 0 && !$empty) {
            $error = 'champs vide';
        } else if ($max !== NULL && $currLength > $max) {
            $isCritical = TRUE;
            $error = 'Ce contenu est trop long, maximum ' . $max . ' charactères.';
        }
        if (empty($errors)) {
            return array('success' => TRUE);
        } else {
            return array('success' => FALSE, 'msg' => $error);
        }
    }
    /**
     * test les différents contenus d'une requête de mise à jour d'un amapien.
     * @param {array} $params
     * @return array('success' => !$isCritical, 'infos' => $errors);
     */
    public
    function amapien ($params=array()) {
        $isCritical = false;
        $errors = array();
        $currLength = 0;
        // /!\ pas de paramètres
        if (count($params) < 1) {
            return FALSE;
        }
        // name
        if (isset($params['name'])) {
            $test = $this->isChar($params['name'], 64, FALSE);
            if ($test['success'] == FALSE) $errors['name'] = $test['msg'];
        }
        // surname
        if (isset($params['surname'])) {
            $test = $this->isChar($params['surname'], 64, FALSE);
            if ($test['success'] == FALSE) $errors['surname'] = $test['msg'];
        }
        // address
        if (isset($params['address'])) {
            $test = $this->isChar($params['address'], 256, FALSE);
            if ($test['success'] == FALSE) $errors['address'] = $test['msg'];
        }
        // zipcode
        if (isset($params['zipcode'])) {
            $test = $this->isChar($params['zipcode'], 12, FALSE);
            if ($test['success'] == FALSE) $errors['zipcode'] = $test['msg'];
        }
        // city
        if (isset($params['city'])) {
            $test = $this->isChar($params['city'], 64, FALSE);
            if ($test['success'] == FALSE) $errors['city'] = $test['msg'];
        }
        // phone
        if (isset($params['phone'])){
            $test = $this->isphone($params['phone']);
            if (!$test['success']) $errors['phone'] = $test['infos'];
        }
        // EMAIL
        if (isset($params['email1'])){
            $test = $this->isMail($params['email1']);
            if (!$test['success']) $errors['email1'] = $test['infos'];
        }
        // DATE
        if (isset($params['arrived'])){
            $test = $this->isMail($params['arrived']);
            if (!$test['success']) $errors['arrived'] = $test['infos'];
        }
        // updated
        if (isset($params['updated'])){
            if ($params['updated'] !== 'on' && $params['updated'] !== 'off') {
                $errors['updated'] = "format non-accepté (val =" . $params['updated'];
            } 
        }
        if (isset($params['contrats'])) {
            // TODO quid des contrats??
        }
        return array('success' => !$isCritical, 'infos' => $errors);
    }
    public
    function contratTest() {

    }
    function __construct() {
        
    }
}
?>
