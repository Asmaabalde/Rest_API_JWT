<?php

error_reporting(E_ALL);
 
date_default_timezone_set('Europe/Paris');
 
$key = "12345";//à changer avec votre clé
$issued_at = time();
$expiration_time = $issued_at + (60 * 60);
$issuer = "http://localhost/Rest-Api-Auth-PHP-JWT/";//à changer avec votre url
?>