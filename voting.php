<?php

//Connect to the database
require_once('models/database.php');
$db = databaseConnection();

    // still need to make this talk to the controller.

if(isset($db)){
    // Create student model
    require_once('models/vote.php');
        $vote = new Vote($db);
        $vote->UpVote($_POST['upVotePost']);
        $vote->DownVote($_POST['downVotePost']);
       
}

// return home
header('Location: ./');
exit();