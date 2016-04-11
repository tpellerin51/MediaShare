<?php // Controller for registration/login

session_start();

if(isset($_POST['task'])){
    require_once('models/database.php');
    $db = databaseConnection();
    
    if(!isset($db)){
        $_SESSION['message'] = "Sorry, could not connect to the database.";
    } else {
        
        if($_POST['task'] == 'register'){
            require_once('models/user.php');
            $user = new User($db, $_POST['username'], $_POST['password'], $_POST['admin']);
            
            $success = $user->register();
            
            if($success){
                $_SESSION['message'] = 'Registered! You can now log in.';
            } else {
                $_SESSION['message'] = 'Sorry, that username is unavailable.';
            }
        } elseif ($_POST['task'] == 'login'){
            require_once('models/user.php');
            $user = new User($db, $_POST['username'], $_POST['password']);
            
            $username = $user->login();
            
            if(isset($username)) {
                session_regenerate_id(true); // New session for login
                $_SESSION['username'] = $username;
            } // *Handle incorrect usernames or passwords with Javascript*
            else {
                $_SESSION['message'] = 'Wrong username or password.';
            }
        }
    }
}

// Return home
header('Location: ./');
exit();
