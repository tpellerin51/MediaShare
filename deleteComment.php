<?php

//Connect to database
require_once('models/database.php');
$db = databaseConnection();


    if(isset($db)){
        require_once('models/comment.php');
        $comments = new Comment($db);
       
        if(isset($_POST['post_ID'])){
            $dropCommentID = ($_POST['post_ID']);
            $comments->deleteComments($dropCommentID);
            return response.print("deleted");
        
        }elseif(isset($_POST['comment_ID'])){
            $dropCommentID = ($_POST['comment_ID']);
            $comments->deleteComment($dropCommentID);
            return response.print("commentDeleted");

        }
    }