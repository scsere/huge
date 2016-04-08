<div class="container">
    <div class="page-header">
        <h1>NoteController/index</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
        <div class="col-lg-12">

            <h3>What happens here ?</h3>
            <p>
                This is just a simple CRUD implementation. Creating, reading, updating and deleting things.
            </p>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>New note</h4>
                    <form method="post" action="<?php echo Config::get('URL'); ?>note/create">
                        <div class="form-group">
                            <label for="note_text">Text of new note: </label>
                            <input type="text" class="form-control" name="note_text" id="note_text"/>
                        </div>
                        <input type="submit" class="btn btn-primary" value='Create this note' autocomplete="off"/>
                    </form>
                </div>
            </div>

            <?php if ($this->notes) { ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Note</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->notes as $key => $value) { ?>
                            <tr>
                                <td><?= $value->note_id; ?></td>
                                <td><?= htmlentities($value->note_text); ?></td>
                                <td><a href="<?= Config::get('URL') . 'note/edit/' . $value->note_id; ?>">Edit</a></td>
                                <td><a href="<?= Config::get('URL') . 'note/delete/' . $value->note_id; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div>No notes yet. Create some !</div>
            <?php } ?>
        </div>
    </div>
</div>
