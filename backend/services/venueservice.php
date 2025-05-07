<?php
require_once __DIR__ . '/../dao/VenueDAO.php';
class VenueService extends BaseService {
    private $venueDAO;
    public function __construct() {
        parent::__construct('VenueDAO');
    }
    public function getAllVenues() {
        return $this->venueDAO->getAll();
    }
    public function getVenueById($id) {
        return $this->venueDAO->getById($id);
    }
    public function createVenue($data) {
        if (empty($data['name']) || empty($data['location'])) {
            throw new Exception("Venue name and location are required");
        }
        return $this->venueDAO->insert($data);
    }
    public function updateVenue($id, $data) {
        return $this->venueDAO->update($id, $data);
    }
    public function deleteVenue($id) {
        return $this->venueDAO->delete($id);
    }
}
?>