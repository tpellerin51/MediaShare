<?php
	// TAKE THIS PHP OUT OF VIEW CONTOLLER
	require_once('models/database.php');
	$db = databaseConnection();
	
	require_once('models/avatars.php');
	$userAvatars = new Avatars($db);
	$profilePic = $userAvatars->getUserURL($_GET['user']);
					
    require_once('models/post.php');
    $allUserPosts = new Post($db);
    $user_rows = $allUserPosts->getUserPosts($_GET['user']);
	
	echo "<h2> <img src=" . $profilePic[0]['url'] . ">" . $_GET['user'] . "'s page" . "</h2>";
	require('views/menu.php');
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
					<td>
						<?php if($tr['username'] == $_SESSION['username'] || $_SESSION['admin'] == 1){
							echo '<button class="deleteButton" name="deletePost" value="'.$tr['post_ID'].'" />Delete Post</button>';
						}?>
					</td>
				</tr>
			<?php endforeach; ?>
        </tbody>
</div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<script src="/views/deletePost.js"></script>
				