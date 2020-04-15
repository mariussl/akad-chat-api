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
    public function get($name) {
        $room = null;
        if (!empty($name)) {
            try {
                $result = $this->repository->get($name);
                if (pg_num_rows($result) === 1) {
                    $room = pg_fetch_object($result);
                }
            } catch(Exception $e) {
                error_log($e->get_Message());
            } finally {
                \AkadChat\Dbutils\freeResult($result);
            }
        }
        return $room;
    }
}
?>