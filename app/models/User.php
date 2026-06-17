<?php

require_once 'app/core/Model.php';

class User extends Model {
    
    public function login($username, $password) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        $user = $this->db->single();
        
        if ($user) {
            // First check if password matches MD5 hash (legacy migration)
            if ($user['password'] === md5($password)) {
                // Securely upgrade password hash to php's native password_hash on the fly
                $newHash = password_hash($password, PASSWORD_BCRYPT);
                $this->db->query("UPDATE users SET password = :hash WHERE id = :id");
                $this->db->bind(':hash', $newHash);
                $this->db->bind(':id', $user['id']);
                $this->db->execute();
                return $user;
            }
            
            // Otherwise check using modern password_verify
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
}
