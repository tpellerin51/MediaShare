<?php

class Vote {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('vote_ID', $this->vote_ID, PDO::PARAM_INT);
        $select->bindParam('post_ID', $this->post_ID, PDO::PARAM_INT);
        $select->bindParam('username', $this->username, PDO::PARAM_STR);
        $select->bindParam('voteType', $this->voteType, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function userVote($post_ID, $username, $voteType){
        $insert = $this->db->prepare('insert into votes(post_ID, username, voteType) values(:post_ID, :username, :voteType)');
        $insert->bindParam(':post_ID', $post_ID, PDO::PARAM_INT);
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':voteType', $voteType, PDO::PARAM_INT);
        return $insert->execute();
    }
    
    function checkVote($username, $post_ID){
        return $this->select("select voteType from votes where username='$username' and post_ID='$post_ID'");
    }
    
    function changeVote($username, $post_ID){
        $update = $this->db->prepare("UPDATE votes SET voteType = voteType * (-1) WHERE username='$username' and post_ID='$post_ID'");
        return $update->execute();
    }
    
    function deleteVote($username, $post_ID){
        $delete = $this->db->prepare("delete from votes where post_ID=:post_ID and username=:username");
        $delete->bindParam(':post_ID', $post_ID, PDO::PARAM_INT);
        $delete->bindParam(':username', $username, PDO::PARAM_STR);
        return $delete->execute();
    }
}