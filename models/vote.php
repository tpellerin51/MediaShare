<?php

class Vote {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
    // Safely acquire the rows
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('username', $this->username, PDO::PARAM_STR);
        $select->bindParam('title', $this->title, PDO::PARAM_STR);
        $select->bindParam('post', $this->post, PDO::PARAM_STR);
        $select->bindParam('upvote', $this->upvote, PDO::PARAM_INT);
        $select->bindParam('downvote', $this->downvote, PDO::PARAM_INT);
        $select->bindParam('post_ID', $this->post_ID, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
	
	function upVote($username, $up_vote, $post_ID){
		$up_vote++;
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':up_vote', $up_vote, PDO::PARAM_STR);
        $insert->bindParam(':post_ID', $post_ID, PDO::PARAM_ID);
        return $insert->execute();
    }
	
	function downVote($username, $down_vote, $post_ID){
		$down_vote--;
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':down_vote', $down_vote, PDO::PARAM_STR);
        $insert->bindParam(':post_ID', $post_ID, PDO::PARAM_ID);
        return $insert->execute();
    }

}