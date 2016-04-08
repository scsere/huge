<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = Session::get('feedback_positive');
$feedback_warning = Session::get('feedback_warning');
$feedback_info = Session::get('feedback_info');
$feedback_negative = Session::get('feedback_negative');

// echo out positive messages
if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissable alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $feedback; ?>
                </div>
            </div>
        </div>
    <?php endforeach;
}

// echo out warning messages
if (isset($feedback_warning)) {
    foreach ($feedback_warning as $feedback): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissable alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $feedback; ?>
                </div>
            </div>
        </div>
    <?php endforeach;
}

// echo out info messages
if (isset($feedback_info)) {
    foreach ($feedback_info as $feedback): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissable alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $feedback; ?>
                </div>
            </div>
        </div>
    <?php endforeach;
}

// echo out negative messages
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $feedback; ?>
                </div>
            </div>
        </div>
    <?php endforeach;
}
