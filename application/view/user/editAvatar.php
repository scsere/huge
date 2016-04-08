<div class="container">
    <div class="page-header">
        <h1>Edit your avatar</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">
        <div class="col-lg-12">
            <h3>Upload an Avatar</h3>

            <div class="alert alert-info">
                If you still see the old picture after uploading a new one: Hard-Reload the page with F5! Your browser
                doesn't
                realize there's a new image as new and old one have the same filename.
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="<?php echo Config::get('URL'); ?>user/uploadAvatar_action" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="avatar_file">Select an avatar image from your hard-disk (will be scaled to 44x44
                                px,
                                only
                                .jpg
                                currently):</label>
                            <input type="file" name="avatar_file" required/>
                        </div>
                        <!-- max size 5 MB (as many people directly upload high res pictures from their digital cameras) -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                        <input type="submit" class="btn btn-primary" value="Upload image"/>
                    </form>
                </div>
            </div>
            <h3>Delete your avatar</h3>
            <p>Click this link to delete your (local) avatar: <a
                    href="<?php echo Config::get('URL'); ?>user/deleteAvatar_action">Delete your avatar</a>
        </div>
    </div>
</div>
