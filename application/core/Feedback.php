<?php

/**
 * Created by PhpStorm.
 * User: Viktor Gobbi
 * Date: 31/03/16
 * Time: 13.14
 *
 * Class for easier feedback messages.
 */
class Feedback
{
    public static function addNegative($text)
    {
        Session::add('feedback_negative', $text);
    }

    public static function addPositive($text)
    {
        Session::add('feedback_positive', $text);
    }

    public static function addWarning($text)
    {
        Session::add('feedback_warning', $text);
    }

    public static function addInfo($text){
        Session::add('feedback_info', $text);
    }
    
    public static function reset(){
        Session::set('feedback_warning', null);
        Session::set('feedback_info', null);
        Session::set('feedback_negative', null);
        Session::set('feedback_positive', null);
    }

    public static function resetType($type){
        Session::set("feedback_$type", null);
    }
}