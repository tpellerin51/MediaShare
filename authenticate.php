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
            $user = new User($db, $_POST['username'], $_POST['password'], $_POST['admin'], $_POST['avatar_ID']);
            
            $success = $user->register();
            
            if($success){
                session_regenerate_id(true);
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = $user->getAdmin($username);
            }else{
                $_SESSION['message'] = 'Sorry, that username is unavailable.';
            }
            
        } elseif ($_POST['task'] == 'login'){

            require_once('models/user.php');
            $user = new User($db, $_POST['username'], $_POST['password']);
            $usernameAdmin = $user->login();

            if(isset($usernameAdmin)) {
                session_regenerate_id(true); // New sessions for login
                $_SESSION['username'] = $usernameAdmin[0];
                $_SESSION['admin'] = $usernameAdmin[1];
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
