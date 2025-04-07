<?php
class CategoryDao extends BaseDao {
    private $pdo;
    public function __construct() {
        parent::__construct("users");
        $this->pdo = Database::connect();
    } public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } public function getCategoryById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = $id");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } public function createCategory($name) {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES $name");
        return $stmt->execute([$name]);
    } public function updateCategory($id, $name) {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = $name WHERE id = $id");
        return $stmt->execute([$name, $id]);
    } public function deleteCategory($id) {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = $id");
        return $stmt->execute([$id]);
    }
}
?>