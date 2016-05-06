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
	
	function UpVote($post_ID){
		$update = $this->db->prepare("UPDATE posts SET upvote = upvote + 1 WHERE post_ID = '$post_ID'");
        return $update->execute();
    }
	
	function DownVote($post_ID){
		$update = $this->db->prepare("UPDATE posts SET downvote = downvote + 1 WHERE post_ID = '$post_ID'");
        return $update->execute();
    }
	
	function getUpVotes($post_ID){
		return $this->select("select upvote from posts where post_ID = '$post_ID'");	
	}
	
	function getDownVotes($post_ID){
		return $this->select("select downvote from posts where post_ID = '$post_ID'");	
	}

}