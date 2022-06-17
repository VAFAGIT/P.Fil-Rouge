<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);



$data = json_decode(file_get_contents("php://input"));


$user->id = $data->id;

$stmt = $user->login();
if ($stmt->rowCount() > 0) {
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id']
    );
} else {
    $user_arr = array(
        "status" => false ,
        "message" => "Invalid id!",
    );
}

// make it json format
print_r(json_encode($user_arr));
