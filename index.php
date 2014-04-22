<?php
require_once 'app/autoload.php';
require 'app/init.php';
$_SESSION['debug'] = TRUE;
$_SESSION['core']  = new Core();
if (isset($_REQUEST['go'])) $_SESSION['currentPage'] = $_REQUEST['go']; else $_SESSION['currentPage'] = 'index';
echo $_SESSION['core']->page();
?>