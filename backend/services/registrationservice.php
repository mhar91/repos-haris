<?php
require_once __DIR__ . '/../dao/RegistrationDAO.php';
class RegistrationService extends BaseService {
    private $registrationDAO;
    public function __construct() {
        parent::__construct('RegistrationDAO');
    }
    public function getAllRegistrations() {
        return $this->registrationDAO->getAll();
    }
    public function getRegistrationById($id) {
        return $this->registrationDAO->getById($id);
    }
    public function createRegistration($data) {
        if (empty($data['user_id']) || empty($data['event_id'])) {
            throw new Exception("User and Event are required for registration");
        }
        return $this->registrationDAO->insert($data);
    }
    public function updateRegistration($id, $data) {
        return $this->registrationDAO->update($id, $data);
    }
    public function deleteRegistration($id) {
        return $this->registrationDAO->delete($id);
    }
}
?>
