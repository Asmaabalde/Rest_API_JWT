<?php
include_once 'config/database.php';


session_start();

$id = $_SESSION['id'];


$db_table = "products";
$database = new Database();
$db = $database->getConnection();
$sqlQuery = "Select * from ". $db_table ;
$stmt = $db->query($sqlQuery);
//à recupérer depuis une base de données
//Chaque Token a une duré de vie
$jwt = $_SESSION['jwt'];

$headers  = getallheaders();
if (array_key_exists("x-auth-token", $headers)) {
    // Utilisation du token récupéré de la session
    if($headers["x-auth-token"] === $jwt ) {
        echo "hello";
        // json_encode($stmt->fetchAll());
    }
}
?>
