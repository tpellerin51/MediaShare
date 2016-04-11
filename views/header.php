<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reddit Esque</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <header class="page-header">
                <h1 class="text-left">ADD TITLE HERE</h1>
                <?php if(isset($_SESSION['username'])):
                    $logoutName = $_SESSION['username']; ?>
                    <p class="text-right">
                        <a href="../logout.php"><?php echo "Logout of " . htmlentities($logoutName) ?></a>
                    </p>
                <?php endif; ?>
                

            </header>
        </div>
    </body>