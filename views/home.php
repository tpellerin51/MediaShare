            <div class="row">
<?php require('views/menu.php'); ?>
                <div class="col-xs-9">
                    <form action="content.php" method="post" id="newPost" class="well">
                        <div id="titlePost" class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div id="postText" class="form-group">
                            <label>Enter your post</label>
                            <input type="text" name="postText" class="form-control">
                        </div>
                        <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
                        <input type="hidden" name="postTask" value="post">
                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                </div>
                
                <div class="col-xs-9">

                   <?php
                   // TAKE THIS PHP OUT OF VIEW CONTOLLER
                   require_once('models/database.php');
                    $db = databaseConnection();
						
                    require_once('models/post.php');
                    $allPosts = new Post($db);
                    $table_rows = $allPosts->getPosts();
					
					require_once('models/avatars.php');
					$userAvatars = new Avatars($db);
					?>
                    
                    
				<table class="table table-hover">
					<thead>
						<th></th>
						<th>Username</th>
						<th>Post</th>
						<th>Votes</th>
					</thead>

					<tbody id="allPosts">
						<?php
						foreach ($table_rows as $tr): ?>
							<tr>
								<td>
									<?php
									
										$upvotes = $allPosts->getUpVotes($tr['post_ID']);
										$downvotes = $allPosts->getDownVotes($tr['post_ID']);
										
										$URL = $userAvatars->getURL($tr['post_ID']);
											
										echo "<a href=\" index.php?user=" . urlencode($tr['username']) . "\"> <img src=" . $URL[0]['url'] . "></a>";
										?>
										</td><td>
										<?php
										echo "<a href=\" index.php?user=" . urlencode($tr['username']) . "\">" . htmlentities($tr['username'], ENT_QUOTES, 'utf-8') . "</a>";
									?>
								</td>
								<td><?php echo "<a href=\" index.php?post=" . urlencode($tr['post_ID']) . "\">" . htmlentities($tr['title'], ENT_QUOTES, 'utf-8') . "</a>"; ?></td>
								<td><?php echo $upvotes[0]['upvote'] - $downvotes[0]['downvote'];?></td>
								<td>
									<?php if($tr['username'] == $_SESSION['username']  || $_SESSION['admin'] == 1){
										echo '<button class="deleteButton" name="deletePost" value="'.$tr['post_ID'].'" />Delete Post</button>';
									}?>
								</td>
							</tr>
						<?php endforeach;?>
						
					</tbody>
				</table>
			</div>
            </div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<script src="/views/deletePost.js"></script>
            <script>
                $(document).ready(function() {
                   
                   //Don't allow posts when errors are present
                   $('#newPost button').on('click', function(event){
                    if (!postValidate()) {
                        event.preventDefault();
                    }
                   });
                   
                   function postValidate() {
                    
                    //Get input values
                    var title = $('#titlePost input').val().trim();
                    var post = $('#postText input').val().trim();
                    
                    //Clear previous error reports
                    $('.form-group').removeClass('has-error');
                    $('.help-block').remove();
                    
                    //Report no title
                    if (!title) {
                        $('#titlePost').append('<span class="help-block">Need Title</span>');
                        $('#titlePost').addClass('has-error');
                        $('#titlePost input').focus();
                        return false;
                    }
                    
                    if (!post) {
                        $('#postText').append('<span class="help-block">You have not made your post</span>');
                        $('#postText').addClass('has-error');
                        $('#postText input').focus();
                        return false;
                    }
                    
                    //No errors
                    return true;
				   } 
                });
            </script>