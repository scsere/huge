<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = Session::get('feedback_positive');
$feedback_warning = Session::get('feedback_warning');
$feedback_info = Session::get('feedback_info');
$feedback_negative = Session::get('feedback_negative');

// echo out positive messages
if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback) {
        echo '<div class="feedback success">'.$feedback.'</div>';
    }
}

// echo out warning messages
if (isset($feedback_warning)) {
    foreach ($feedback_warning as $feedback) {
        echo '<div class="feedback warning">'.$feedback.'</div>';
    }
}

// echo out info messages
if (isset($feedback_info)) {
    foreach ($feedback_info as $feedback) {
        echo '<div class="feedback info">'.$feedback.'</div>';
    }
}

// echo out negative messages
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback) {
        echo '<div class="feedback error">'.$feedback.'</div>';
    }
}
