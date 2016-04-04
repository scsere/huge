<div class="container">
    <div class="page-header">
        <h1>UserController/editUserEmail</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Change your email address</h2>

                    <form action="<?php echo Config::get('URL'); ?>user/editUserEmail_action" method="post">
                        <div class="form-group">
                            <label for="user_email"> New email address: </label>
                            <input type="text" class="form-control" name="user_email" id="user_email" required/>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
