<div class="container">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
        <div class="col-lg-3"></div>
        <!-- login box on left side -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Register a new account</h2>

                    <!-- register form -->
                    <form method="post" action="<?php echo Config::get('URL'); ?>register/register_action">
                        <!-- the user name input field uses a HTML5 pattern check -->
                        <div class="form-group">
                            <input type="text" class="form-control" pattern="[a-zA-Z0-9]{2,64}" name="user_name"
                                   placeholder="Username (letters/numbers, 2-64 chars)" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_email"
                                   placeholder="email address (a real address)" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="user_email_repeat"
                                   placeholder="repeat email address (to prevent typos)"
                                   required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="user_password_new" pattern=".{6,}"
                                   placeholder="Password (6+ characters)"
                                   required autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="user_password_repeat" pattern=".{6,}"
                                   required
                                   placeholder="Repeat your password" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag -->
                            <img id="captcha" src="<?php echo Config::get('URL'); ?>register/showCaptcha"/>
                            <!-- quick & dirty captcha reloader -->
                            <a href="#" class="help-block"
                               onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>register/showCaptcha?' + Math.random(); return false">Reload
                                Captcha</a>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="captcha"
                                   placeholder="Please enter above characters" required/>
                        </div>
                        <input class="btn btn-lg btn-primary" type="submit" value="Register"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
