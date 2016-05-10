<?php

//Connect to the database
require_once('models/database.php');
$db = databaseConnection();

    // still need to make this talk to the controller.

if(isset($db)){
    // Create student model
    require_once('models/post.php');
        $vote = new Post($db);
        
        if(isset($_POST['upVotePost']))
            $vote->upVote($_POST['upVotePost']);
            
        elseif(isset($_POST['downVotePost']))
            $vote->downVote($_POST['downVotePost']);
            
       
}

// return home
header('Location: index.php?post='. $_POST['post_ID']);
exit();