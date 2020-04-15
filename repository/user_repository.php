<?php
namespace AkadChat\Repository;

class UserRepository {
    private $tableId = "public.user";
    private $dbConnection = null;
    public function setDbConnection($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function list() {
        return \AkadChat\Dbutils\queryParams($this->dbConnection, "SELECT * FROM $this->tableId", null);        
    }

    public function get($name) {
        return \AkadChat\Dbutils\queryParams($this->dbConnection,
            "SELECT * FROM ".$this->tableId." where ".$this->tableId.".name = $1", array($name));
    }

}
?>