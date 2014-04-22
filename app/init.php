<?php
include_once 'autoload.php';
if (session_name() === 'PHPSESSID') {session_name('amaposaure'); }
session_start();
function init()
{
    try {
        if ( !isset($_SESSION['core']) )
        {
            /*
            //echo 'core n existe pas, ';
            $_SESSION['noUser'] = TRUE;
            if ( isset($_SESSION['userID'])
            &&         $_SESSION['userID'] != "" )
            {
                //echo 'userID existe, ';
                if ( isset($_SESSION['userData'] ) ) {
                    //echo 'Ptah_StrUsr existe, ';
                    $profil = $_SESSION['userData'];
                }
                else {
                    //echo 'SET(), ';
                    $req = new Modele();
                    $strResults = $req->setIdentification($_SESSION['userID']);
                    if ( $strResults->success )
                        $profil = $strResults->userData;
                }
                $_SESSION['noUser'] = FALSE;
                $_SESSION['core'] = new Core();
                $_SESSION['core']->init($profil);
            }
            */
            $profil             = NULL;
            $_SESSION['noUser'] = FALSE;
            $_SESSION['core']   = new Core();
            $_SESSION['core']->init($profil);
        }
    }
    catch (Exception $error)
    {
        echo 'ACTIVITÉ Error : ' . $error;
    }
}
init();
?>