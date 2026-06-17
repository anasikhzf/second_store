<?php

require_once 'app/core/Model.php';

class Blog extends Model {

    public function getAll($limit = null, $offset = null) {
        $sql = "SELECT * FROM blog ORDER BY id DESC";
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }
        
        $this->db->query($sql);
        if ($limit !== null && $offset !== null) {
            $this->db->bind(':limit', (int)$limit, PDO::PARAM_INT);
            $this->db->bind(':offset', (int)$offset, PDO::PARAM_INT);
        }
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM blog WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function getRelated($id, $limit = 5) {
        $this->db->query("SELECT id, title FROM blog WHERE id != :id ORDER BY id DESC LIMIT :limit");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countAll() {
        $this->db->query("SELECT COUNT(*) as total FROM blog");
        $res = $this->db->single();
        return $res ? $res['total'] : 0;
    }

    public function add($data) {
        $this->db->query("INSERT INTO blog (title, content, image) VALUES (:title, :content, :image)");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['image']);
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function update($id, $data) {
        $sql = "UPDATE blog SET title = :title, content = :content";
        if (isset($data['image'])) {
            $sql .= ", image = :image";
        }
        $sql .= " WHERE id = :id";

        $this->db->query($sql);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        if (isset($data['image'])) {
            $this->db->bind(':image', $data['image']);
        }
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM blog WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->execute();
    }
}
