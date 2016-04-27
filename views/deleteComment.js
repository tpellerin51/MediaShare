$(document).ready(function() {
    deleteComment();
});

function deleteComment() {
    $('.deleteCommentButton').on('click', function(event){
       var comment_ID = ($(this).attr('value'));
       var $row = $(this).parent().parent();

       
       $.post('deleteComment.php', {'comment_ID' : comment_ID}, function(response){
               console.log(comment_ID);
            if (response == 'commentDeleted') {
                console.log("HERE");
                $row.remove();
                alert('Comment Removed!');
            }
       });
    });
}