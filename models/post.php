<?php

class Post {
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
    
    // Attempt to add post
    function post($username, $post, $title){
        $insert = $this->db->prepare('insert into posts(username, post, title, upvote, downvote) values(:username, :post, :title, 0, 0)');
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':post', $post, PDO::PARAM_STR);
        $insert->bindParam(':title', $title, PDO::PARAM_STR);
        return $insert->execute();
    }
    
    function getPosts(){
        return $this->select("select * from posts order by upvote - downvote DESC");
    }
    
    function getUserPosts($user){
        return $this->select("select * from posts where username= '$user'");
    }
    
    function getSinglePost($id){
        return $this->select("select * from posts where post_ID= '$id'");
    }
    
    function deletePost($id){
        $delete = $this->db->prepare("delete from posts where post_ID=:id");
        $delete->bindParam(':id', $id, PDO::PARAM_INT);
        return $delete->execute();
    }
    
    function upVote($post_ID){
		$update = $this->db->prepare("UPDATE posts SET upvote = upvote + 1 WHERE post_ID = '$post_ID'");
        return $update->execute();
    }
	
	function downVote($post_ID){
		$update = $this->db->prepare("UPDATE posts SET downvote = downvote + 1 WHERE post_ID = '$post_ID'");
        return $update->execute();
    }
	
	function upVoteAfterDown($post_ID){
		$update = $this->db->prepare("UPDATE posts SET upvote = upvote + 2 WHERE post_ID = '$post_ID'");
        return $update->execute();
    }
	
	function downVoteAfterUp($post_ID){
		$update = $this->db->prepare("UPDATE posts SET downvote = downvote + 2 WHERE post_ID = '$post_ID'");
        return $update->execute();
    }
	
	function getUpVotes($post_ID){
		return $this->select("select upvote from posts where post_ID = '$post_ID'");	
	}
	
	function getDownVotes($post_ID){
		return $this->select("select downvote from posts where post_ID = '$post_ID'");	
	}
}