<?php
	
	// TAKE THIS PHP OUT OF VIEW CONTOLLER
	require_once('models/database.php');
	$db = databaseConnection();
	
    require_once('models/post.php');
    $posts = new Post($db);

	$user_rows = $posts->getSinglePost($_GET['post']);
	
	require('views/menu.php');
?>
	
<div class="col-xs-9">
	
	<?php foreach($user_rows as $tr):
		echo "<h2>" . $tr['title'] . ' - ' . "<a href=\" index.php?user=" . urlencode($tr['username']) . "\">" . htmlentities($tr['username'], ENT_QUOTES, 'utf-8') . "</a>" . "</h2>"; ?>
        
		<br><br>
		
		<?php echo htmlentities($tr['post'], ENT_QUOTES, 'utf-8');

	endforeach; ?>
	
	<form id="commentForm">
		<button id="comment" type="button">Comment</button>
	</form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			
<script>    
    var mainForm = document.getElementById("commentForm"),
        textBox = document.createElement("input");
		submit = document.createElement("button");

    textBox.id="commentBox";
    textBox.type="text";
	
	submit.id="addComment";
	submit.type="button";
	

    document.getElementById("comment").onclick = function () {
         mainForm.appendChild(textBox);
		 mainForm.appendChild(submit);
    }

    document.getElementById("addComment").onclick = function () {
		console.log("here");
		if (!postValidation()) {
           event.preventDefault();
        }
        mainForm.removeChild(textBox);
		mainForm.removeChild(submit);
    }
	
	function postValidation() {
        var comment = $('#commentBox input').val().trim();
		
		//Clear previous error reports
        $('.form-group').removeClass('has-error');
        $('.help-block').remove();
		
		if (!comment) {
            $('#commentBox').append('<span class="help-block">Enter a comment</span>');
            $('#commentBox').addClass('has-error');
            $('#commentBox input').focus();
            return false;            
        }
		
		return true;
    }
</script>	

</div>
