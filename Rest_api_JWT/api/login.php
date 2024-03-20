<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'config/core.php';
include_once 'libs/JWT.php';
use \JWTLib\JWT;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $email = $_POST['email'];
    $password = $_POST['password'];
}

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$user = new User($db);

// // get posted data
// $data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->email = $email;
$email_exists = $user->emailExists();

// check if email exists and if password is correct
if($email_exists && password_verify($password, $user->password)){
    $token = array(
       "iat" => $issued_at,
       "exp" => $expiration_time,
       "iss" => $issuer,
       "data" => array(
           "id" => $user->id,
           "firstname" => $user->firstname,
           "lastname" => $user->lastname,
           "email" => $user->email
       )
    );

    // set response code
    http_response_code(200);
    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );
    $id = $user->id;
    $_SESSION['id'] = $id;
    $_SESSION['jwt'] = $jwt;
}
// login failed
else{
    // set response code
    http_response_code(401);
    // tell the user login failed
    echo json_encode(array("message" => "Login failed.",
        "email_exists" => $email_exists,
        "db_PWD" =>$user->password,
        "data_PWD" => $password));
}
