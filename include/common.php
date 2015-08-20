//common file
<?php
require_once '../vendor/autoload.php';

session_start();


header('X-XRDS-Location: http://' . $_SERVER['SERVER_NAME'] .
     '/services.xrds.php');


$db = new PDO('mysql:host=localhost;dbname=oauth', 'root', 'root');


$store = OAuthStore::instance('PDO', array('conn' => $db));
$server = new OAuthServer();
