<?php

require_once 'dao/categorydao.php';
require_once 'services/baseservice.php';

class CategoryService extends BaseService {
    public function __construct() {
        parent::__construct('CategoryDAO');
    }
    public function getAllCategories() {
        return $this->dao->getAll();
    }
    public function getCategoryById($id) {
        return $this->dao->getById($id);
    }  
    public function createCategory($data) {
        return $this->dao->insert($data);
    }
    public function updateCategory($id, $data) {
        return $this->dao->update($id, $data);
    }
    public function deleteCategory($id) {
        return $this->dao->delete($id);
    }
}

?>