<!DOCTYPE html>
<html>
<head>
    <title><?php echo Head::getTitle(); ?></title>
    <!-- META -->
<?php foreach (Head::getMetaTags() as $metaTag):?>
    <meta <?php echo $metaTag; ?>>
<?php endforeach;?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
    <link rel="icon" href="<?php echo Head::getIcon();?>">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css" />

    <!-- JS -->
    <script type="text/javascript" src="<?php echo Config::get('URL'); ?>js/jquery-2.2.2.min.js"></script>
    <script type="text/javascript" src="<?php echo Config::get('URL'); ?>js/bootstrap.min.js"></script>
</head>
<body>
<?php if (Config::get('GA_ENABLED')): ?>
        <!-- Google analytics -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', '<?php echo Config::get('GA_TRACKING_ID'); ?>', 'auto');
        ga('send', 'pageview');
        </script>
<?php endif; ?>

        <!-- logo -->
        <div class="logo"></div>
        <!-- navigation -->
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>index/index">Index</a>
                        </li>
                        <li <?php if (View::checkForActiveController($filename, "profile")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>profile/index">Profiles</a>
                        </li>
                        <?php if (Session::userIsLoggedIn()) { ?>
                            <li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>dashboard/index">Dashboard</a>
                            </li>
                            <li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>note/index">My Notes</a>
                            </li>
                        <?php } else { ?>
                            <!-- for not logged in users -->
                            <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
                            </li>
                            <li <?php if (View::checkForActiveControllerAndAction($filename, "register/index")) { echo ' class="active" '; } ?> >
                                <a href="<?php echo Config::get('URL'); ?>register/index">Register</a>
                            </li>
                        <?php } ?>
                    </ul>

                    <!-- my account -->
                    <ul class="nav navbar-nav navbar-right">
                    <?php if (Session::userIsLoggedIn()) : ?>
                        <li class="<?php if (View::checkForActiveController($filename, "user")) { echo 'active '; } ?> dropdown" >
                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown">My Account
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li <?php if (View::checkForActiveControllerAndAction($filename, "user/changeUserRole")) { echo ' class="active" '; } ?> >
                                    <a href="<?php echo Config::get('URL'); ?>user/changeUserRole">Change account type</a>
                                </li>
                                <li <?php if (View::checkForActiveControllerAndAction($filename, "user/editAvatar")) { echo ' class="active" '; } ?> >
                                    <a href="<?php echo Config::get('URL'); ?>user/editAvatar">Edit your avatar</a>
                                </li>
                                <li <?php if (View::checkForActiveControllerAndAction($filename, "user/editusername")) { echo ' class="active" '; } ?> >
                                    <a href="<?php echo Config::get('URL'); ?>user/editusername">Edit my username</a>
                                </li>
                                <li <?php if (View::checkForActiveControllerAndAction($filename, "user/edituseremail")) { echo ' class="active" '; } ?> >
                                    <a href="<?php echo Config::get('URL'); ?>user/edituseremail">Edit my email</a>
                                </li>
                                <li <?php if (View::checkForActiveControllerAndAction($filename, "user/changePassword")) { echo ' class="active" '; } ?> >
                                    <a href="<?php echo Config::get('URL'); ?>user/changePassword">Change Password</a>
                                </li>
                                <li <?php if (View::checkForActiveControllerAndAction($filename, "login/logout")) { echo ' class="active" '; } ?> >
                                    <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
                                </li>
                            </ul>
                        </li>
                        <?php if (Session::get("user_account_type") == 7) : ?>
                        <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>admin/">Admin</a>
                        </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>