<?php

//Connect to database
require_once('models/database.php');
$db = databaseConnection();


    if(isset($db)){
        
        session_start();
        require_once('models/post.php');
        $post = new Post($db);
        
        require_once('models/vote.php');
        $vote = new Vote($db);
        
        $dropPost_ID = ($_POST['post_ID']);
        $post->deletePost($dropPost_ID);
        
        $vote->deleteVote($_SESSION['username'], $_POST['post_ID']);
        
        return response.print("deleted!");
    }