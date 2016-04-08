<div class="container">
    <div class="page-header">
        <h1>ProfileController/showProfile/:id</h1>
    </div>
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
        <div class="col-lg-12">
            <h3>What happens here ?</h3>
            <div>This controller/action/view shows all public information about a certain user.</div>

            <?php if ($this->user) { ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>User's email</th>
                            <th>Activated ?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="<?= ($this->user->user_active == 0 ? '' : 'active'); ?>">
                            <td><?= $this->user->user_id; ?></td>
                            <td class="avatar">
                                <?php if (isset($this->user->user_avatar_link)) { ?>
                                    <img src="<?= $this->user->user_avatar_link; ?>"/>
                                <?php } ?>
                            </td>
                            <td><?= $this->user->user_name; ?></td>
                            <td><?= $this->user->user_email; ?></td>
                            <td><?= ($this->user->user_active == 0 ? 'No' : 'Yes'); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
