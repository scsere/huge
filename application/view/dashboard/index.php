<div class="container">
    <div class="page-header">
        <h1>DashboardController/index</h1>
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <div class="row">
        <div class="col-lg-12">
            <h3>What happens here ?</h3>
            <p>
                This is an area that's only visible for logged in users. Try to log out, an go to /dashboard/ again.
                You'll
                be redirected to /index/ as you are not logged in. You can protect a whole section in your app within
                the
                according controller by placing <i>Auth::handleLogin();</i> into the constructor.
            <p>
        </div>
    </div>
</div>
