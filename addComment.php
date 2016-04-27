<?php

//Connect to the database
require_once('models/database.php');
$db = databaseConnection();

    if(isset($db)){
        // Create student model
        require_once('models/comment.php');
        $comment = new Comment($db);
        $comment->comment($_POST['username'], trim($_POST['comment']), $_POST['post_ID']);
        return response.print('posted');
    }