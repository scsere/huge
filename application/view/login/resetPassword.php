<div class="container">
    <div class="page-header">
        <h1>LoginController/resetPassword</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Set new password</h2>
                    <!-- new password form box -->
                    <form method="post" action="<?php echo Config::get('URL'); ?>login/setNewPassword"
                          name="new_password_form">
                        <input type='hidden' name='user_name' value='<?php echo $this->user_name; ?>'/>
                        <input type='hidden' name='user_password_reset_hash'
                               value='<?php echo $this->user_password_reset_hash; ?>'/>
                        <div class="form-group">
                            <label for="reset_input_password_new">New password (min. 6 characters)</label>
                            <input id="reset_input_password_new" class="form-control" type="password"
                                   name="user_password_new" pattern=".{6,}" required autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <label for="reset_input_password_repeat">Repeat new password</label>
                            <input id="reset_input_password_repeat" class="form-control" type="password"
                                   name="user_password_repeat" pattern=".{6,}" required autocomplete="off"/>
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit_new_password" value="Submit new password"/>
                    </form>

                    <a href="<?php echo Config::get('URL'); ?>login/index">Back to Login Page</a>
                </div>
            </div>
        </div>
    </div>
</div>
