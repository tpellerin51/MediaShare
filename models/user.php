<?php

class User {
    
    private $db; // PDO connection
    private $username, $password, $admin; // Credentials offered
    
    function __construct($db, $username, $password, $admin) {
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
    }
    
    // Attempt to add this user and return whether it worked
    function register() {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $insert = $this->db->prepare('insert into users(username,password) values(:username,:password)');
        $insert->bindParam(':username', $this->username, PDO::PARAM_STR);
        $insert->bindParam(':password', $hash, PDO::PARAM_STR);
        $insert->bindParam(':admin', $this->admin, PDO::PARAM_INT);
        return $insert->execute();
    }
    
    // Attempt to return the ID of this user
    function login() {
        $select = $this->db->prepare('select * from users where username=:username');
        $select->bindParam(':username', $this->username, PDO::PARAM_STR);
        $select->execute();
        
        $row = $select->fetch(PDO::FETCH_ASSOC);
        if (isset($row) && password_verify($this->password, $row['password'])) {
            return $row['username'];
        } else {
            return NULL;
        }
    }
}