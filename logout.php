<?php // Controller for logging out

session_start();

// End login session
$_SESSION = array();
setcookie(session_name(), FALSE);
session_destroy();

// Return to login page
header('Location: ./');
exit();