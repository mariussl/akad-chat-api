<?php
namespace AkadChat\Repository;

class RoomRepository {
    private $tableId = "public.room";
    private $dbConnection = null;
    public function setDbConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function list() {
        return \AkadChat\Dbutils\queryParams($this->dbConnection, "SELECT * FROM $this->tableId", null);        
    }

}
?>