<div class="container">
    <div class="page-header">
        <h1>Request a password reset</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="box">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- request password reset form box -->
                    <form method="post" action="<?php echo Config::get('URL'); ?>login/requestPasswordReset_action">
                        <div class="form-group">
                            <label for="user_name_or_email"> Enter your username or email and you'll get a mail with
                                instructions: </label>
                            <input type="text" class="form-control" name="user_name_or_email" id="user_name_or_email"
                                   required/>
                        </div>
                        <?= Captcha::getCaptchaHtml() ?>
                        <input type="submit" class="btn btn-primary" value="Send me a password-reset mail"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
