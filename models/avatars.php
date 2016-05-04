<?php

class Avatars {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    //Safely Acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('avatar_ID', $this->avatar_ID, PDO::PARAM_INT);
        $select->bindParam('url', $this->url, PDO::PARAM_STR);
        $select->bindParam('post_ID', $this->post_ID, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getAvatars(){
        return $this->select("select * from avatars order by avatar_ID");
    }
    
    function getURL($post_ID){
        return $this->select("select url from avatars natural join users natural join posts where post_ID='$post_ID'");
    }
    
    function getURLComments($comment_ID){
        return $this->select("select url from avatars natural join users natural join comments where comment_ID='$comment_ID'");
    }
    
    function getUserURL($username){
        return $this->select("select url from avatars natural join users where username='$username'");
    }
}
    
    