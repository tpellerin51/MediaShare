<?php

//Connect to the database
require_once('models/database.php');
$db = databaseConnection();


if(isset($db)){
    session_start();
    // Create student model
    require_once('models/post.php');
    $post = new Post($db);
        
    require_once('models/vote.php');
    $vote = new Vote($db);
        
        if(isset($_POST['upVotePost'])){
            $voteType = $vote->checkVote($_SESSION['username'], $_POST['upVotePost']);
            if($voteType[0]['voteType'] == 1){
                header('Location: index.php?post='. $_POST['post_ID']);
                exit();
            }elseif($voteType[0]['voteType'] == -1){
                $post->upVoteAfterDown($_POST['upVotePost']);
                $vote->changeVote($_SESSION['username'], $_POST['upVotePost']);
                
            }else{
                $post->upVote($_POST['upVotePost']);
                $vote->userVote($_POST['upVotePost'], $_SESSION['username'], 1);
            }

        }
            
        elseif(isset($_POST['downVotePost'])){
            $voteType = $vote->checkVote($_SESSION['username'], $_POST['downVotePost']);
            if($voteType[0]['voteType'] == -1){
                header('Location: index.php?post='. $_POST['post_ID']);
                exit();
            }elseif($voteType[0]['voteType'] == 1){
                $post->downVoteAfterUp($_POST['downVotePost']);
                $vote->changeVote($_SESSION['username'], $_POST['downVotePost']);  
            }else{
                $post->downVote($_POST['downVotePost']);
                $vote->userVote($_POST['downVotePost'], $_SESSION['username'], -1);
            }
        }
       
}

// return home
header('Location: index.php?post='. $_POST['post_ID']);
exit();