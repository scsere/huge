<div class="container">
    <div class="page-header">
        <h1>NoteController/edit/:note_id</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Edit a note</h2>
                    <?php if ($this->note) { ?>
                        <form method="post" action="<?php echo Config::get('URL'); ?>note/editSave">
                            <div class="form-group">
                                <label for="note_text">Change text of note: </label>
                                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                                <input type="hidden" name="note_id"
                                       value="<?php echo htmlentities($this->note->note_id); ?>"/>
                                <input type="text" class="form-control" name="note_text" id="note_text"
                                       value="<?php echo htmlentities($this->note->note_text); ?>"/>
                            </div>
                            <input type="submit" class="btn btn-primary" value='Change'/>
                        </form>
                    <?php } else { ?>
                        <p class="red-text">This note does not exist.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
