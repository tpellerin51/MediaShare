<?php

session_start();

// Should have form inputs
if (isset($_POST['postTask'])){
    
    
    //Connect to database
    require_once('models/database.php');
    $db = databaseConnection();
    
    
    if(!isset($db)){
        $_SESSION['contentMessage'] = "Could not connect to database.";
    } else {
        if($_POST['postTask'] == 'post'){
        
            require_once('models/post.php');
            $post = new Post($db);
        
            $posted = $post->post($_POST['username'], $_POST['postText'], $_POST['title']);
        
            if($posted){
                $_SESSION['contentMessage'] = 'Posted!';
            } else {
                $_SESSION['contentMessage'] = 'Sorry, your post could not be posted.';
            }
        }
    }
}

// Return home
header('Location: ./');
exit();