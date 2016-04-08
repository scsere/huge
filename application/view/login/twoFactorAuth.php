<?php
/**
 * Created by PhpStorm.
 * User: Viktor Gobbi
 * Date: 07/04/16
 * Time: 16.02
 * Project: huge
 * File: twoFactorAuth.php
 */
?>
<script type="text/javascript" src="<?= Config::get('URL') . 'public/js/jquery.countdown.min.js' ?>"></script>
<div class="container">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="login-page-box">
        <div class="table-wrapper">

            <!-- login box on left side -->
            <div class="login-box">
                <h2>Enter one time password</h2>
                <span id="clock"></span>
                <script type="text/javascript">
                    $(function () {
                        $('#clock').countdown(<?= (int)(Session::get('user_login_timestamp')+Config::get('TWO_FACTOR_AUTH_TIMEOUT'))*1000?>, function (event) {
                            $(this).html(event.strftime('%M:%S'));
                        });
                    });
                </script>
                <form action="<?php echo Config::get('URL'); ?>login/tokenLogin_action" method="post">
                    <input type="text" name="token" placeholder="One time token"
                           pattern="\d{<?= Config::get('TWO_FACTOR_AUTH_DIGITS') ?>}|\d{<?= Config::get('TWO_FACTOR_AUTH_SCRATCH_CODES_DIGITS') ?>}"
                           autocomplete="off" required/>
                    <!-- when a user navigates to a page that's only accessible for logged a logged-in user, then
                         the user is sent to this page here, also having the page he/she came from in the URL parameter
                         (have a look). This "where did you came from" value is put into this form to sent the user back
                         there after being logged in successfully.
                         Simple but powerful feature, big thanks to @tysonlist. -->
                    <?php if (!empty($this->redirect)) { ?>
                        <input type="hidden" name="redirect" value="<?php echo $this->encodeHTML($this->redirect); ?>"/>
                    <?php } ?>
                    <!--
                        set CSRF token in login form, although sending fake login requests mightn't be interesting gap here.
                        If you want to get deeper, check these answers:
                            1. natevw's http://stackoverflow.com/questions/6412813/do-login-forms-need-tokens-against-csrf-attacks?rq=1
                            2. http://stackoverflow.com/questions/15602473/is-csrf-protection-necessary-on-a-sign-up-form?lq=1
                            3. http://stackoverflow.com/questions/13667437/how-to-add-csrf-token-to-login-form?lq=1
                    -->
                    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>"/>
                    <input type="submit" class="login-submit-button" value="Confirm"/>
                    <a class="btn btn-primary" href="<?php echo Config::get('URL'); ?>login/cancelTokenLogin">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

