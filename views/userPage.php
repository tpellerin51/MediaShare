<?php

	echo ("<h2 class='text-left'>" . $_GET['user'] . "'s page" . "</h2>");
	require('views/menu.php');

	// TAKE THIS PHP OUT OF VIEW CONTOLLER
	require_once('models/database.php');
	$db = databaseConnection();
					
    require_once('models/post.php');
    $allUserPosts = new Post($db);
    $user_rows = $allUserPosts->getUserPosts($_GET['user']);
?>
	
<div class="col-xs-9">
	

    <table class="table table-hover text-center">
		<thead>
			<th>Title</th>
		</thead>
        
        <tbody>
            <?php
            foreach ($user_rows as $tr): ?>
				<tr>
					<td>
					    <?php echo "<a href=\" index.php?post=" . urlencode($tr['post_ID']) . "\">" . htmlentities($tr['title'], ENT_QUOTES, 'utf-8') . "</a>"; ?>
					</td>
				</tr>
			<?php endforeach; ?>
        </tbody>
</div>