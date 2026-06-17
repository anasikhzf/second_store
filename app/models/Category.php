<?php

require_once 'app/core/Model.php';

class Category extends Model {
    
    public function getAll() {
        $this->db->query("SELECT * FROM category ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM category WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function add($name) {
        $this->db->query("INSERT INTO category (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        return $this->db->execute();
    }

    public function update($id, $name) {
        $this->db->query("UPDATE category SET name = :name WHERE id = :id");
        $this->db->bind(':name', $name);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM category WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function countAll() {
        $this->db->query("SELECT COUNT(*) as total FROM category");
        $res = $this->db->single();
        return $res ? $res['total'] : 0;
    }
}
