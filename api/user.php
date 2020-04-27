<?php
require("../service/user_service.php");
require("../repository/user_repository.php");
require("response.php");
require("../db_utils.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$dbConnection = \AkadChat\Dbutils\connect();
$userRepository = new \AkadChat\Repository\UserRepository();
$userRepository->setDbConnection($dbConnection);
$userService = new \AkadChat\Service\UserService();
$userService->setRepository($userRepository);
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["name"])) {
        $name = htmlspecialchars($_GET["name"]);
    }
    if (!empty($name)) {
        $result = $userService->get($name);
    } else {
        $result = $userService->list();
    }
    $response = new \AkadChat\Api\Response();
    if ($result != null) {
        $response->type = "1";
        $response->payload = $result;
    } else {
        $response->type ="2";
        $response->payload = "no data found";
    }
    echo json_encode($response);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $newUser = json_decode($json);
    $result = $userService->save($newUser);
    $response = new \AkadChat\Api\Response();
    $response->type = "1";
    $response->payload = $result;
    echo json_encode($response);
} elseif ($_SERVER["REQUEST_METHOD"] === "PUT") {
    http_response_code(200);
} elseif ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Headers: *");
    http_response_code(200);
} else {
    http_response_code(404);
    echo json_encode(
        array("error" => "Unknown method: ". $_SERVER["REQUEST_METHOD"])
    );
}
?>