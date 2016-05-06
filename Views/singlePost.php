<?php

	// TAKE THIS PHP OUT OF VIEW CONTOLLER
	require_once('models/database.php');
	$db = databaseConnection();
	
    require_once('models/post.php');
    $posts = new Post($db);

	$user_rows = $posts->getSinglePost($_GET['post']);
	
	require_once('models/comment.php');
	$comments = new Comment($db);

	$allComments = $comments->getPostComments($_GET['post']);
	
	$username = $_SESSION['username'];
	
	require_once('models/vote.php');
	
	$allVotes = new Vote($db);
	
	require('views/menu.php');
?>
	
<div class="col-xs-9">
	<div class="bg-success">
		<?php foreach($user_rows as $tr):
			$upvotes = $allVotes->getUpVotes($tr['post_ID']);
			$downvotes = $allVotes->getDownVotes($tr['post_ID']);
			echo "<h2>" . $tr['title'] . ' - ' . "<a href=\" index.php?user=" . urlencode($tr['username']) . "\">" . htmlentities($tr['username'], ENT_QUOTES, 'utf-8') . "</a>" . "</h2>";
			echo "<h5> UpVotes: " . $upvotes[0]['upvote'] . "<br> DownVotes:" . $downvotes[0]['downvote'] ."</h5>"; ?>
			
			<br><br>
		
			<?php echo htmlentities($tr['post'], ENT_QUOTES, 'utf-8'); ?>
			
			<br>
			<?php if($tr['username'] == $_SESSION['username']){

				echo '<button class="deleteButton" id="deletePost" name="deletePost" value="'.$tr['post_ID'].'" />Delete Post</button>';
				echo "<form action= 'voting.php' method= 'post'>";
				echo '<button type= "submit" id="upVotePost" name="upVotePost" value="'.$tr['post_ID'].'" />UpVote Post</button>';
				echo '<button type= "submit" id="downVotePost" name="downVotePost" value="'.$tr['post_ID'].'" />DownVote Post</button>';
				echo "</form>";
			}
			
		endforeach; ?>
		</div>
	<br><br>
	
	<div class="col-xs-9">
		
		<h3> Comments </h3>
		<table class="table table-hover text-center" id="theComments">
		<?php foreach($allComments as $tr): ?>
		
			<tr>
				<td> <?php echo "<a href=\" index.php?user=" . urlencode($tr['username']) . "\">" . htmlentities($tr['username'], ENT_QUOTES, 'utf-8') . "</a>"; ?></td>
				<td> <?php echo htmlentities($tr['comment']); ?></td>
				<td>
					<?php if($tr['username'] == $_SESSION['username']){
						echo '<button class="deleteCommentButton" name="deleteComment" value="'.$tr['comment_ID'].'" />Delete Comment</button>';
					}?>
				</td>
			</tr>
			
		<?php endforeach; ?>
		</table>
	</div>
		<div id="container" class="col-xs-9">
	    <div id="mainContent">
	        <div id="addcomment"> <button href='#'>Add Comment</button></div>
			<div id='postComment'>
				
					<textarea name='comment' id='comment'></textarea>
					<button id= 'postCommentButton'>Post Comment</button>
				
			</div>
		</div>
	</div>
</div>
	

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="/views/deletePost.js"></script>
	<script src="/views/deleteComment.js"></script>
	
    <script type="text/javascript" language="javascript">
		$(document).ready(function(){
			$('#addcomment').click(function () {
				var comments = true;
				if($('#postComment').show("slow")){
				
					$('#postCommentButton').on('click', function(event) {
						event.preventDefault();
						//Get input text
						var comment = $('#comment').val().trim();
						var post_ID = "<?php echo $_GET['post'];?>";
						var username = "<?php echo $_SESSION['username'];?>" ;
						
					
						if (postValidation() && comments == true) {
							$.post('addComment.php', {'username':username, 'comment':comment, 'post_ID':post_ID}, function(response){
								
								
								var tr = '<tr>' +
									'<td>' + username + '</td>' +
									'<td>' + comment + '</td>';
									
								if (response == 'posted') {
                                    $('#theComments').append(tr);
									$("#comment").val('');
									$('#postComment').hide();
									comments = false;
                                }
							});
						}
					
					});
				}
			});
		});
		
		function postValidation() {
        var comment = $('#comment').val().trim();

		//Clear previous error reports
        $('.form-group').removeClass('has-error');
        $('.help-block').remove();
		
		if (!comment) {
			console.log("here");
            $('#postComment').append('<span class="help-block">Enter a comment</span>');
            $('#postComment').addClass('has-error');
            $('#postComment').focus();
            return false;            
        }
		
		return true;
    }
    </script>
	
