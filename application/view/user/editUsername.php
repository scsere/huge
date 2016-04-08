<div class="container">
    <div class="page-header">
        <h1>UserController/editUsername</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Change your username</h2>

                    <form action="<?php echo Config::get('URL'); ?>user/editUserName_action" method="post">
                        <!-- btw http://stackoverflow.com/questions/774054/should-i-put-input-tag-inside-label-tag -->
                        <div class="form-group">
                            <label for="user_name"> New username: </label>
                            <input type="text" class="form-control" name="user_name" id="user_name" required/>
                        </div>
                        <!-- set CSRF token at the end of the form -->
                        <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
