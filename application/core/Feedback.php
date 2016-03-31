<?php

/**
 * Created by PhpStorm.
 * User: Viktor Gobbi
 * Date: 31/03/16
 * Time: 13.14
 */
class Feedback
{
    public static function negative($text)
    {
        Session::add('feedback_negative', $text);
    }

    public static function positive($text)
    {
        Session::add('feedback_positive', $text);
    }

    public static function warning($text)
    {
        Session::add('feedback_warning', $text);
    }

    public static function info($text){
        Session::add('feedback_info', $text);
    }
    
    public static function reset(){
        Session::set('feedback_warning', null);
        Session::set('feedback_info', null);
        Session::set('feedback_negative', null);
        Session::set('feedback_positive', null);
    }
}