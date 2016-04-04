<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- echo out the system feedback (error and success messages) -->
                <?php $this->renderFeedbackMessages(); ?>
            </div>
        </div>

        <div class="row">
            <!-- login box on left side -->
            <div class="col-lg-6">
                <div class="panel panel-default panel-body">
                    <h2>Login here</h2>
                    <form action="<?php echo Config::get('URL'); ?>login/login" method="post">
                        <div class="form-group">
                            <input type="text" name="user_name" class="form-control" placeholder="Username or email"
                                   required/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_password" class="form-control" placeholder="Password"
                                   required/>
                        </div>
                        <div class="checkbox">
                            <label for="set_remember_me_cookie">
                                <input type="checkbox" name="set_remember_me_cookie">
                                Remember me for 2 weeks
                            </label>
                        </div>
                        <!-- when a user navigates to a page that's only accessible for logged a logged-in user, then
                             the user is sent to this page here, also having the page he/she came from in the URL parameter
                             (have a look). This "where did you came from" value is put into this form to sent the user back
                             there after being logged in successfully.
                             Simple but powerful feature, big thanks to @tysonlist. -->
                        <?php if (!empty($this->redirect)) { ?>
                            <input type="hidden" name="redirect"
                                   value="<?php echo $this->encodeHTML($this->redirect); ?>"/>
                        <?php } ?>
                        <!--
                            set CSRF token in login form, although sending fake login requests mightn't be interesting gap here.
                            If you want to get deeper, check these answers:
                                1. natevw's http://stackoverflow.com/questions/6412813/do-login-forms-need-tokens-against-csrf-attacks?rq=1
                                2. http://stackoverflow.com/questions/15602473/is-csrf-protection-necessary-on-a-sign-up-form?lq=1
                                3. http://stackoverflow.com/questions/13667437/how-to-add-csrf-token-to-login-form?lq=1
                        -->
                        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>"/>
                        <button type="submit" class="btn btn-lg btn-default">Log in</button>
                    </form>
                    <div class="form-group">
                        <a class="help-block" href="<?php echo Config::get('URL'); ?>login/requestPasswordReset">I
                            forgot my password</a>
                    </div>
                </div>
            </div>

            <!-- register box on right side -->
            <div class="col-lg-6">
                <div class="panel panel-default panel-body">
                    <h2>No account yet ?</h2>
                    <a href="<?php echo Config::get('URL'); ?>register/index"
                       class="btn btn-info btn-lg btn-block">Register</a>
                </div>
            </div>

        </div>
    </div>
</div>
