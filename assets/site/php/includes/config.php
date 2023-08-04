<?php
	
ob_start();
session_start();


//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','films');

$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
$db -> exec("set names utf8");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//set timezone
date_default_timezone_set('Europe/London');

$classes_paths = array(
'../classes/user.php',
'../classes/films.php',
'../assets/site/php/classes/user.php',
'../assets/site/php/classes/films.php',
'../../assets/site/php/classes/user.php',
'../../assets/site/php/classes/films.php');
foreach ($classes_paths as $path) {
    $classpath = $path;
	 if ( file_exists($classpath)) {
        require_once $classpath;
    }
}
   


$user = new User($db);
$films = new Film($db);
