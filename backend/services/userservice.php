<?php
require_once __DIR__ . '/../dao/UserDAO.php';
class UserService extends BaseService {
    private $userDAO;
    public function __construct() {
        parent::__construct('UserDao');
    }
    public function getAllUsers() {
        return $this->userDAO->getAll();
    }
    public function getUserById($id) {
        return $this->userDAO->getById($id);
    }
    public function createUser($data) {
        if (empty($data['name']) || empty($data['email'])) {
            throw new Exception("Name and Email are required");
        }
        return $this->userDAO->createUser($data);
    }
    public function updateUser($id, $data) {
        return $this->userDAO->update($id, $data);
    }
    public function deleteUser($id) {
        return $this->userDAO->delete($id);
    }
}
?>