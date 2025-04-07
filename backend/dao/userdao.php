<?php
require_once 'basedao.php';
class UserDao extends BaseDao {
    private $pdo;
    public function __construct() {
       parent::__construct("users");
    }  public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  public function getUserById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = $id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }  public function createUser($data) {
        $stmt = $this->connection->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_BCRYPT));
        return $stmt->execute();
    }
    public function updateUser($id, $data) {
        $stmt = $this->connection->prepare("UPDATE users SET name = :name, email = :email WHERE id = $id");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function deleteUser($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = $id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
   public function getByName($name) {
       $stmt = $this->connection->prepare("SELECT * FROM users WHERE name = $name");
       $stmt->bindParam(':name', $name);
       $stmt->execute();
       return $stmt->fetch();
    }
   public function getByEmail($email) {
       $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = $email");
       $stmt->bindParam(':email', $email);
       $stmt->execute();
       return $stmt->fetch();
   }
}
?>