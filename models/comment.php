<?php

class Comment {

    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('username', $this->username, PDO::PARAM_STR);
        $select->bindParam('comment', $this->comment, PDO::PARAM_STR);
        $select->bindParam('comment_ID', $this->comment_ID, PDO::PARAM_INT);
        $select->bindParam('post_ID', $this->post_ID, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function comment($username, $comment, $post_ID){
        $insert = $this->db->prepare('insert into comments(username, comment, post_ID) values(:username, :comment, :post_ID)');
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':comment', $comment, PDO::PARAM_STR);
        $insert->bindParam(':post_ID', $post_ID, PDO::PARAM_INT);
        return $insert->execute();
    }
    
    
    function getPostComments($post_ID){
        return $this->select("select * from comments where post_ID= '$post_ID'");
    }
    
    function deleteComments($deleteID){
        $delete = $this->db->prepare("delete from comments where post_ID=:id");
        $delete->bindParam(':id', $deleteID, PDO::PARAM_INT);
        return $delete->execute();
    }
    
    function deleteComment($deleteID){
        $delete = $this->db->prepare("delete from comments where comment_ID=:id");
        $delete->bindParam(':id', $deleteID, PDO::PARAM_INT);
        return $delete->execute();
    }
}