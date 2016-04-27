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
	
	require('views/menu.php');
?>
	
<div class="col-xs-9">
	<div class="bg-success">
		<?php foreach($user_rows as $tr):
			echo "<h2>" . $tr['title'] . ' - ' . "<a href=\" index.php?user=" . urlencode($tr['username']) . "\">" . htmlentities($tr['username'], ENT_QUOTES, 'utf-8') . "</a>" . "</h2>"; ?>
        
			<br><br>
		
			<?php echo htmlentities($tr['post'], ENT_QUOTES, 'utf-8');

		endforeach; ?>
		</div>
	<br><br>
	
	<div class="col-xs-9" id="theComments">
		
		<h3> Comments </h3>
		<table class="table table-hover text-center">
		<?php foreach($allComments as $tr): ?>
		
			<tr>
				<td> <?php echo "<a href=\" index.php?user=" . urlencode($tr['username']) . "\">" . htmlentities($tr['username'], ENT_QUOTES, 'utf-8') . "</a>"; ?></td>
				<td> <?php echo htmlentities($tr['comment']); ?></td>
			</tr>
			
		<?php endforeach; ?>
		</table>
	</div>
		<div id="container" class="col-xs-9">
	    <div id="mainContent">
	        <div id="addcomment"> <button href='#'>Add Comment</button></div>
			<div id='postComment'>
				<form method="post">
					<textarea name='comment' id='comment'></textarea>
					<button id= 'postCommentButton'>Post Comment</button>
				</form>
			</div>
		</div>
	</div>
</div>
	

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	

    <script type="text/javascript" language="javascript">
		$(document).ready(function(){
			$('#addcomment').click(function () {
				if($('#postComment').show("slow")){
				
					$('#postCommentButton').on('click', function(event) {
						
						//Get input text
						var comment = $('#comment').val().trim();
						var post_ID = "<?php echo $_GET['post'];?>";
						var username = "<?php echo $_SESSION['username'];?>" ;
					
						if (!postValidation()) {
							event.preventDefault();
						} else {
							$.post('addComment.php', {'username':username, 'comment':comment, 'post_ID':post_ID}, function(response){
								
								//this line took an hr :(
								var linkUsername = "<?php echo '`<a href=\` index.php?user=` . urlencode('; ?>" + username + "<?php echo ') . `\>'; ?>" + username + "<?php echo '</a>'; ?>"; 
								
								var tr = '<tr>' +
									'<td>' + linkUsername.substring(1) + '</td>' +
									'<td>' + comment + '</td>';
									
								if (response == 'posted') {
                                    $('#theComments').append(tr);
									event.preventDefault();
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
	
