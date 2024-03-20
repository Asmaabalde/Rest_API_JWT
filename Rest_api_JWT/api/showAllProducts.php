<?php
session_start();

include_once '../api/config/database.php';
$jwt = $_SESSION['jwt']; 
echo $jwt;

// utilisation du token récupéré de la session dans l'en-tête de la requête
$headers = array();
$headers[] = "x-auth-token: $jwt"; // Utilisation le token de session

$url = "http://localhost/ece2025/TP2/Rest_api_JWT/api/getAllProducts.php"; // Lien complet à compléter
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt($client, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($client);
$results = json_decode($response);
echo($response);

//Affichage des résultats
echo "<table>";
    foreach ($results as $result) {
        echo "<tr><td>product_id:</td><td>$result->product_id</td></tr>";
        echo "<tr><td>product_name:</td><td>$result->product_name</td></tr>";
        echo "<tr><td>product_description:</td><td>$result->product_description</td></tr>";
        echo "<tr><td>dossier:</td><td>$result->dossier</td></tr>";
        echo "<tr><td>category_id:</td><td>$result->category_id</td></tr>";
        echo "<tr><td>in_stock:</td><td>$result->in_stock</td></tr>";
        echo "<tr><td>price:</td><td>$result->price</td></tr>";
        echo "<tr><td>brand:</td><td>$result->brand</td></tr>";
        echo "<tr><td>nbr_image:</td><td>$result->nbr_image</td></tr>";
        echo "<tr><td>date_added:</td><td>$result->date_added</td></tr>";
    }
    echo "</table>";
?>
