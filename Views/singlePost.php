<?php
	echo ("<h2 class='text-left'>" . $_GET['user'] . "'s post" . "</h2>");
    require('views/menu.php');
    
    // TAKE THIS PHP OUT OF VIEW CONTOLLER
	require_once('models/database.php');
	$db = databaseConnection();
    
    require_once('models/post.php');
    $allUserPosts = new Post($db);
    $post_row = $allUserPosts->getUserPosts($_GET['post_ID']);
    
    // need to also get array of post's comments up here i think

?>

<div class="col-xs-9">
    
    <header>
        <?php echo "<a href=\" index.php?post_ID=" . urlencode($tr['post_ID']) . "\">" . htmlentities($tr['title'], ENT_QUOTES, 'utf-8') . "</a>"; ?>
    </header>
    <body>
        <?php echo htmlentities($tr['post'], ENT_QUOTES, 'utf-8'); ?>
    </body>
    
    // echo out all comments in a table here 
    <table class="table table-hover text-center">
        <?php foreach ($user_rows as $tr): ?>
        
    
        <?php endforeach; ?>
    </table>
    
    // need to add in comment and vote buttons to here soon. 
    
    
</div>