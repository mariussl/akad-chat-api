<?php
namespace AkadChat\Service;

class MessageService {
    private $repository = null;
    public function setRepository($repository) {
        $this->repository = $repository;
    }
    public function list($roomname) {
        $messageList = array();
        try {
            $result = $this->repository->list($roomname);
            while ($message = pg_fetch_object($result)) {
                array_push($messageList, $message);
            }
        } catch(Exception $e) {
            error_log($e->get_Message());
        } finally {
            \AkadChat\Dbutils\freeResult($result);
        }
        return $messageList;
    }
    public function get($id) {
        $message = null;
        if (!empty($id)) {
            try {
                $result = $this->repository->get($id);
                if (pg_num_rows($result) === 1) {
                    $room = pg_fetch_object($result);
                }
            } catch(Exception $e) {
                error_log($e->get_Message());
            } finally {
                \AkadChat\Dbutils\freeResult($result);
            }
        }
        return $message;
    }
    public function save($newMessage) {
        if (!empty($newMessage)) {
            try {
                $this->repository->save($newMessage);
            } catch(Exception $e) {
                error_log($e->get_Message());
                return false;
            }
        }
        return true;
    }
}
?>