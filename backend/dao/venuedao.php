<?php
class VenueDAO extends BaseDAO {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    } public function getAllVenues() {
        $stmt = $this->pdo->query("SELECT * FROM venues");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } public function getVenueById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM venues WHERE id = $id");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } public function createVenue($name, $address, $capacity) {
        $stmt = $this->pdo->prepare("INSERT INTO venues (name, address, capacity) VALUES ($name, $address, $capacity)");
        return $stmt->execute([$name, $address, $capacity]);
    } public function updateVenue($id, $name, $address, $capacity) {
        $stmt = $this->pdo->prepare("UPDATE venues SET name = $name, address = $address, capacity = $capacity WHERE id = $id");
        return $stmt->execute([$name, $address, $capacity, $id]);
    } public function deleteVenue($id) {
        $stmt = $this->pdo->prepare("DELETE FROM venues WHERE id = $id");
        return $stmt->execute([$id]);
    }
}
?>