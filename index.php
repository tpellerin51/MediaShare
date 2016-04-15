<?php

session_start();

//Show home page if logged in
require('views/header.php');
require(isset($_SESSION['username']) ? isset($_GET['user']) ? 'views/userPage.php' : isset($_GET['post']) ? 'views/singlePost.php' :'views/home.php' : 'views/login.php');
require('views/footer.php');
