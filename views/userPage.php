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
			<th>Username</th>
			<th>Post</th>
		</thead>
        
        <tbody>
            <?php
            foreach ($user_rows as $tr): ?>
				<tr>
					<td><?php echo "<a href=\" index.php?user=" . urlencode($tr['username']) . "\">" . htmlentities($tr['username'], ENT_QUOTES, 'utf-8') . "</a>"; ?></td>
					<td>
                        <b>
                            <?php echo htmlentities($tr['title'], ENT_QUOTES, 'utf-8'); ?>
                        </b><br>
                        <?php echo htmlentities($tr['post'], ENT_QUOTES, 'utf-8'); ?>
					</td>
					<form action='models/comment.php' method='get'>
						<?php echo '<td><button type="submit" name="comment" value="'.$tr['post_ID'].'" />Comment</td>';?>
					</form>
					</tr>
				<?php endforeach; ?>
        </tbody>
</div>