<?php
require_once "controllers/App.php";

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET,PUT,PUSH,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    echo json_encode(["message"=>"succes"]);
    exit();
        }

$Route = new App;
$Route->reqRoute();