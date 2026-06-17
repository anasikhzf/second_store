<?php

require_once 'app/core/Model.php';

class Product extends Model {
    
    public function getAll($limit = null, $offset = null, $search = '', $category = '') {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id 
                WHERE 1";
        
        if (!empty($search)) {
            $sql .= " AND p.name LIKE :search";
        }
        if (!empty($category)) {
            $sql .= " AND c.name = :category";
        }
        
        $sql .= " ORDER BY p.id DESC";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }
        
        $this->db->query($sql);
        
        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        if (!empty($category)) {
            $this->db->bind(':category', $category);
        }
        if ($limit !== null && $offset !== null) {
            $this->db->bind(':limit', (int)$limit, PDO::PARAM_INT);
            $this->db->bind(':offset', (int)$offset, PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }

    public function getLatest($limit = 5) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id 
                ORDER BY p.id DESC LIMIT :limit";
        $this->db->query($sql);
        $this->db->bind(':limit', (int)$limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getById($id) {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id 
                WHERE p.id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function getRelated($id, $limit = 4) {
        $sql = "SELECT * FROM product WHERE id != :id ORDER BY id DESC LIMIT :limit";
        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countAll($search = '', $category = '') {
        $sql = "SELECT COUNT(*) as total 
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id 
                WHERE 1";
        
        if (!empty($search)) {
            $sql .= " AND p.name LIKE :search";
        }
        if (!empty($category)) {
            $sql .= " AND c.name = :category";
        }
        
        $this->db->query($sql);
        
        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        if (!empty($category)) {
            $this->db->bind(':category', $category);
        }
        
        $res = $this->db->single();
        return $res ? $res['total'] : 0;
    }

    public function add($data) {
        $sql = "INSERT INTO product (name, description, price, category_id, image, product_condition, status, defect) 
                VALUES (:name, :description, :price, :category_id, :image, :condition, :status, :defect)";
        
        $this->db->query($sql);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':condition', $data['condition']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':defect', $data['defect']);
        
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function update($id, $data) {
        $sql = "UPDATE product SET 
                    name = :name, 
                    description = :description, 
                    price = :price, 
                    category_id = :category_id, 
                    product_condition = :condition, 
                    status = :status, 
                    defect = :defect";
        
        if (isset($data['image'])) {
            $sql .= ", image = :image";
        }
        
        $sql .= " WHERE id = :id";
        
        $this->db->query($sql);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':condition', $data['condition']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':defect', $data['defect']);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        
        if (isset($data['image'])) {
            $this->db->bind(':image', $data['image']);
        }
        
        return $this->db->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM product WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->execute();
    }
}
