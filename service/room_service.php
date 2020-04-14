<?php
namespace AkadChat\Service;

class RoomService {
    private $repository = null;
    public function setRepository($repository) {
        $this->repository = $repository;
    }
    public function list() {
        $roomList = array();
        try {
            $result = $this->repository->list();
            while ($room = pg_fetch_object($result)) {
                array_push($roomList, $room);
            }
        } catch(Exception $e) {
            error_log($e->get_Message());
        } finally {
            \AkadChat\Dbutils\freeResult($result);
        }
        return $roomList;
    }
}
?>