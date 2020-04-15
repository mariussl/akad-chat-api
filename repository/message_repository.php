<?php
namespace AkadChat\Repository;

class MessageRepository {
    private $tableId = "public.message";
    private $dbConnection = null;
    public function setDbConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function list($roomname) {
        return \AkadChat\Dbutils\queryParams($this->dbConnection,
            "SELECT * FROM $this->tableId where roomname = $1 order by createtime", array($roomname));
    }

    public function get($id) {
        return \AkadChat\Dbutils\queryParams($this->dbConnection,
            "SELECT * FROM $this->tableId where id = $1", array($id));
    }

    public function save($newMessage) {
        \AkadChat\Dbutils\queryParams($this->dbConnection,
            "INSERT INTO public.message(roomname, username, text) VALUES ($1, $2, $3)",
            array($newMessage->roomname, $newMessage->username, $newMessage->text));
    }

}
?>