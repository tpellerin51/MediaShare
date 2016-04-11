<?php

session_start();

//Show home page if logged in
require('views/header.php');
require(isset($_SESSION['username']) ? 'views/home.php' : 'views/login.php');
require('views/footer.php');
