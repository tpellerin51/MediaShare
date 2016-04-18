<?php

var post_ID;
var voteDownScript='voteDown.php';
var voteUpScript='voteUp.php';

// vote up
$("button.up").click(function(){ // when people click an up button
	$("div#response").show().html('<h2>voting, please wait...</h2>'); // show wait message

	itemID=$(this).val(); // get post id

	$.post(voteUpScript,{id:itemID},function(response){ // post to up script
		$("div#response").html(response).hide(3000); // show response
	});

	$(this).attr({"disabled":"disabled"}); // disable button
 });

 // vote down
 $("button.down").click(function(){
	$("div#response").show().html('<h2>voting, please wait...</h2>');

	itemID=$(this).val();
	$.post(voteDownScript,{id:itemID},function(response){ // post to down script
		$("div#response").html(response).hide(3000); // show response
	});
	$(this).attr({"disabled":"disabled"}); // disable button

 });
 
 
?>



<button value="1" class="up">UpVote</button>
		<button value="1" class="down">DownVote</button>
        	<fieldset>
                <h2>Post 1</h2>
                    HI
                    <p>
                        <button value="1" class="up">UpVote</button>
                        <button value="1" class="down">DownVote</button>
                    </p>
            </fieldset>
            
    <div id="response">
	</div>
            
     
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		// all jquery code will go here
    	});
</script>

