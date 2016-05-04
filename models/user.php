<?php

class User {
    
    private $db; // PDO connection
    private $username, $password, $admin, $avatar_ID; // Credentials offered
    
    function __construct($db, $username, $password, $admin, $avatar_ID) {
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
        $this->avatar_ID = $avatar_ID;
    }
    
    //Safely Acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('username', $this->username, PDO::PARAM_STR);
        $select->bindParam('password', $this->password, PDO::PARAM_STR);
        $select->bindParam('admin', $this->admin, PDO::PARAM_INT);
        $select->bindParam('avatar_ID', $this->avatar_ID, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Attempt to add this user and return whether it worked
    function register() {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $insert = $this->db->prepare('insert into users(username,password,admin,avatar_ID) values(:username,:password,:admin,:avatar_ID)');
        $insert->bindParam(':username', $this->username, PDO::PARAM_STR);
        $insert->bindParam(':password', $hash, PDO::PARAM_STR);
        $insert->bindParam(':admin', $this->admin, PDO::PARAM_INT);
        $insert->bindParam(':avatar_ID', $this->avatar_ID, PDO::PARAM_INT);
        return $insert->execute();
    }
    
    function getAdmin($username){
        return $this->select("select admin from users where username='$username'");
    }
    
    // Attempt to return the ID of this user
    function login() {
        $select = $this->db->prepare('select * from users where username=:username');
        $select->bindParam(':username', $this->username, PDO::PARAM_STR);
        $select->execute();
        
        $row = $select->fetch(PDO::FETCH_ASSOC);
        if (isset($row) && password_verify($this->password, $row['password'])) {
            $admin = $this->getAdmin($row['username']);
            return array ($row['username'], $admin[0]['admin']);
        } else {
            return NULL;
        }
    }
    

}