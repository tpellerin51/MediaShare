<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MediaShare</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="views/style.css">
    </head>
    
    <?php if(isset($_SESSION['username'])): ?>
    <body>
    <?php else: ?>
    <body class="loginRegister">
    <?php endif; ?>
        <div class="container">

            <header class="page-header">
                <h1 class="text-left">MediaShare</h1>
                
                <?php if(isset($_SESSION['username'])):
                    $logoutName = $_SESSION['username']; ?>
                    <p class="text-right">
                        <a href="../logout.php"><?php echo "Logout of " . htmlentities($logoutName) ?></a>
                    </p>
                <?php
                else: ?>
                    <h4 class="text-left">Welcome to MediaShare! Do you have something you want to get out there and share with the world?
                                      This site is the place for you. Vote or comment on other users posts to let them know your thoughts and opinions.</h4>
                    <h6 class="text-left">*This is a user friendly page so please refrain from vulgar language and inappropriate comments. Thank you!*</h6>
                <?php endif; ?>
                
            </header>
        </div></div>
    </body>