<?php

session_start();

//Show home page if logged in
require('views/header.php');
if(isset($_SESSION['username'])){
    if(isset($_GET['post']))
        require('views/singlePost.php');
        
    elseif(isset($_GET['user']))
    
        require('views/userPage.php');
    else
        require('views/home.php');
    }
    
else{
   require('views/login.php');
}

require('views/footer.php');