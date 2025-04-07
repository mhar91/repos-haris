<?php
class EventDao extends BaseDao {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    } public function getAllEvents() {
        $stmt = $this->pdo->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } public function getEventById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE id = $id");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } public function createEvent($title, $description, $category_id, $venue_id, $start_time, $end_time, $created_by) {
        $stmt = $this->pdo->prepare("INSERT INTO events (title, description, category_id, venue_id, start_time, end_time, created_by) VALUES ($title, $description, $category_id, $venue_id, $start_time, $end_time, $created_by)");
        return $stmt->execute([$title, $description, $category_id, $venue_id, $start_time, $end_time, $created_by]);
    } public function updateEvent($id, $title, $description, $category_id, $venue_id, $start_time, $end_time) {
        $stmt = $this->pdo->prepare("UPDATE events SET title = $title, description = $description, category_id = $category_id, venue_id = $venue_id, start_time = $start_time, end_time = $end_time WHERE id = $id");
        return $stmt->execute([$title, $description, $category_id, $venue_id, $start_time, $end_time, $id]);
    } public function deleteEvent($id) {
        $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = $id");
        return $stmt->execute([$id]);
    }
}
?>