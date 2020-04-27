<?php
require("../service/message_service.php");
require("../repository/message_repository.php");
require("response.php");
require("../db_utils.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$dbConnection = \AkadChat\Dbutils\connect();
$messageRepository = new \AkadChat\Repository\MessageRepository();
$messageRepository->setDbConnection($dbConnection);
$messageService = new \AkadChat\Service\MessageService();
$messageService->setRepository($messageRepository);
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = htmlspecialchars($_GET["id"]);
    }
    if (!empty($id)) {
        $result = $messageService->get($id);
    } elseif (isset($_GET["roomname"])) {
        $roomname = htmlspecialchars($_GET["roomname"]);
        $messageList = $messageService->list($roomname);
    } else {
        $messageList = [];
    }
    $response = new \AkadChat\Api\Response();
    $response->type = "1";
    $response->payload = $messageList;
    echo json_encode($response);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $newMessage = json_decode($json);
    $result = $messageService->save($newMessage);
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