<?php
require("../service/room_service.php");
require("../repository/room_repository.php");
require("response.php");
require("../db_utils.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$dbConnection = \AkadChat\Dbutils\connect();
$roomRepository = new \AkadChat\Repository\RoomRepository();
$roomRepository->setDbConnection($dbConnection);
$roomService = new \AkadChat\Service\RoomService();
$roomService->setRepository($roomRepository);
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["name"])) {
        $name = htmlspecialchars($_GET["name"]);
    }
    if (!empty($name)) {
        $result = $roomService->get($name);
    } else {
        $result = $roomService->list();
    }
    $response = new \AkadChat\Api\Response();
    $response->type = "1";
    $response->payload = $result;
    echo json_encode($response);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
} elseif ($_SERVER["REQUEST_METHOD"] === "PUT") {
} else {
    http_response_code(404);
    echo json_encode(
        array("error" => "Unknown method: ". $_SERVER["REQUEST_METHOD"])
    );
}
?>