            $(document).ready(function() {
               deletePost();
            });
				function deletePost() {
					$('.deleteButton').on('click', function(event){
                        var redirect = ($(this).attr('id'));
						var post_ID = ($(this).attr('value'));
						var $row = $(this).parent().parent();
						
						$.post('deleteComment.php', {'post_ID' : post_ID}, function(response){
							if (response == 'deleted') {
								$.post('deletePost.php', {'post_ID' : post_ID}, function(response){
									if (response == 'deleted!') {
										$row.remove();
										alert("Post removed!");
                                        if (redirect == 'deletePost') {
                                            location.href = "index.php";
                                        }
									}
								});
                            }
						});
					});
                }