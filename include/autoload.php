<?php
define('CLASS_DIRECTORY','include');
define('CLASS_EXTENSION','.php');
/**
 * Recherche d'un fichier dans un dossier et son arborescence
 * @param str $dir dossier ou chercher
 * @param str $filename nom du fichier a chercher
 * @return str chemin complet du fichier ou bool false si introuvable
 */
function searchFile ($dir, $filename)
{
//  echo $filename."<br/>\n";

    //si pas de slash final on l'ajoute
    $last = $dir[strlen($dir)-1];
    if($last != '/' && $last != '\\') {
        $dir .= '/';
    }
    //chargement dossier
    $filelist = new DirectoryIterator($dir);
    //on boucle le contenu
    foreach($filelist as $file) {
        //si . ou .. on zappe
        if ($file->isDot()) {continue; }
        //si dir on explore
        if($file->isDir()) {
            //si on trouve on renvoi
            if($res = searchFile($dir.$file->getFilename(),$filename)) {
                return $res;
            //sinon on continue
            } else {
                continue;
            }
        }
        //si on a un fichier correspondant à ce qu'on cherche, on le renvoi
        if($file->getFilename() === $filename) {
            return $dir.$file->getFilename();
        }
    }
    //si on a rien trouvé on renvoi faux
    return false;
}
/**
 * Autoload de classes
 * @param str $class_name nom de la classe
 * @return bool
 */
/*
function __autoload($class_name)*/
function       load($class_name)
{
//  echo $class_name."<br/>\n";

    if (strpos($class_name, 'Mustache') !== FALSE) {
        return false;
    }

//  $pos = strpos($class_name, "__");
//  if ( $pos !== FALSE ) {
//  //  echo $pos."<br/>\n";
//      return false;
//  }

    // test sur racine des classes
    if($file = searchFile(CLASS_DIRECTORY,$class_name.CLASS_EXTENSION)) {
    //  echo $file."<br/>\n";
        include_once $file;
        return true;
    }
    //si fichier non trouvé, la classe n'existe pas, on leve une exception
    throw new Exception('Classe '.$class_name.' introuvable.');
    return false;
}

spl_autoload_register('load');
?>
