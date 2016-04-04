<div class="container">
    <div class="page-header">
        <h1>UserController/showProfile</h1>
    </div>
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
        <div class="col-lg-12">
            <h2>Your profile</h2>
            <div>Your username: <?= $this->user_name; ?></div>
            <div>Your email: <?= $this->user_email; ?></div>
            <div>Your avatar image:
                <?php if (Config::get('USE_GRAVATAR')) { ?>
                    Your gravatar pic (on gravatar.com): <img src='<?= $this->user_gravatar_image_url; ?>'/>
                <?php } else { ?>
                    Your avatar pic: <img src='<?= $this->user_avatar_file; ?>'/>
                <?php } ?>
            </div>
            <div>Your account type is: <?= $this->user_account_type; ?></div>
        </div>
    </div>
</div>
