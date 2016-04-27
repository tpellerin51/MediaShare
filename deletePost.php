<?php

//Connect to database
require_once('models/database.php');
$db = databaseConnection();


    if(isset($db)){
        require_once('models/post.php');
        $post = new Post($db);
        $dropPost_ID = ($_POST['post_ID']);
        $post->deletePost($dropPost_ID);
        return response.print("deleted!");
    }