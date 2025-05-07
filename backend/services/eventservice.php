<?php
require_once __DIR__ . '/../dao/EventDAO.php';
require_once __DIR__ . '/../BaseService.php';
class EventService extends BaseService {
    private $eventDAO;
    public function __construct() {
        parent::__construct('EventDAO');
    }
    public function getAllEvents() {
        return $this->dao->getAll();
    }
    public function getEventById($id) {
        return $this->eventDAO->getById($id);
    }
    public function createEvent($data) {
        if (empty($data['title']) || empty($data['start_time']) || empty($data['venue_id'])) {
            throw new Exception("Title, Start Time, and Venue are required");
        }
        return $this->eventDAO->createEvent($data, $data['venue_id'], $data['user_id'], $data['description'], $data['end_time'], $data['image'], $data['category_id']);
    }

    public function updateEvent($id, $data) {
        return $this->eventDAO->update($id, $data);
    }

    public function deleteEvent($id) {
        return $this->eventDAO->delete($id);
    }
}
?>
