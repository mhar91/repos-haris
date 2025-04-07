<?php
class RegistrationDao extends BaseDao {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    } public function getAllRegistrations() {
        $stmt = $this->pdo->query("SELECT * FROM registrations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } public function getRegistrationById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM registrations WHERE id = $id");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } public function createRegistration($user_id, $event_id) {
        $stmt = $this->pdo->prepare("INSERT INTO registrations (user_id, event_id) VALUES ($user_id, $event_id)");
        return $stmt->execute([$user_id, $event_id]);
    } public function updateRegistration($id, $user_id, $event_id) {
        $stmt = $this->pdo->prepare("UPDATE registrations SET user_id = $user_id, event_id = $event_id WHERE id = $id");
        return $stmt->execute([$user_id, $event_id, $id]);
    } public function deleteRegistration($id) {
        $stmt = $this->pdo->prepare("DELETE FROM registrations WHERE id = $id");
        return $stmt->execute([$id]);
    }
}
?>