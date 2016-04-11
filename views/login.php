            <div class="row">
                <div class="col-sm-6">
                    <h3>Login</h3>
                    <form action="authenticate.php" method="post" id="login" class="well">
                        <div id="usernameLogin" class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div id="passwordLogin" class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <input type="hidden" name="task" value="login">
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h3>Register</h3>
                    <form action="authenticate.php" method="post" id="register" class="well">
                        <div id="usernameRegister" class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div id="passwordRegister" class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div id="confirm" class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control">
                        </div>
                        <input type="hidden" name="admin" value=0>
                        <input type="hidden" name="task" value="register">
                        <button type="submit" class="btn btn-default">Register</button>
                    </form>
                </div>
<?php if (isset($_SESSION['message'])): ?>
                <div class="row">
                    <p class="text-info text-center"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></p>
                </div>
<?php endif; ?>
            </div>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                
            <script>
                $(document).ready(function() {
                   
                   //Don't allow login or register if errors
                   $('#login button').on('click', function(event) {
                    if (!loginValidate()) {
                        event.preventDefault();
                    }
                   });
                   
                   $('#register button').on('click', function(event){
                    if (!registerValidate()) {
                        event.preventDefault();
                    }
                   });
                   
                   function loginValidate() {
                    
                    //Get input values
                    var username = $('#usernameLogin input').val().trim();
                    var password = $('#passwordLogin input').val().trim();
                    
                    // Clear previous error reports
                    $('.form-group').removeClass('has-error');
                    $('.help-block').remove();
                    
                    // Report usernames that are in use or empty
                    if (!username) {
                        $('#usernameLogin').append('<span class="help-block">Need Username</span>');
                        $('#usernameLogin').addClass('has-error');
                        $('#usernameLogin input').focus();
                        return false;
                    }
                    
                    // Report empty or incorrect passwords
                    if (!password) {
                        $('#passwordLogin').append('<span class="help-block">Need Password</span>');
                        $('#passwordLogin').addClass('has-error');
                        $('#passwordLogin input').focus();
                        return false;
                    }
                    
                    
                    // No errors
                    return true;
                   }
                   
                   function registerValidate() {
                    
                    //Get input values
                    var username = $('#usernameRegister input').val().trim();
                    var password = $('#passwordRegister input').val().trim();
                    var confirm = $('#confirm input').val().trim();
                    
                    // Clear previous error reports
                    $('.form-group').removeClass('has-error');
                    $('.help-block').remove();
                    
                    // Report usernames that are in use or empty
                    if (!username) {
                        $('#usernameRegister').append('<span class="help-block">Need Username</span>');
                        $('#usernameRegister').addClass('has-error');
                        $('#usernameRegister input').focus();
                        return false;
                    }
                    
                    // Report empty passwords
                    if (!password) {
                        $('#passwordRegister').append('<span class="help-block">Need Password</span>');
                        $('#passwordRegister').addClass('has-error');
                        $('#passwordRegister input').focus();
                        return false;
                    }
                    
                    if (password != confirm) {
                        $('#confirm').append('<span class="help-block">Passwords do not match</span>');
                        $('#confirm').addClass('has-error');
                        $('#confirm input').focus();
                        return false;
                    }
                    
                    // No errors
                    return true;
                   }
                });
            </script>