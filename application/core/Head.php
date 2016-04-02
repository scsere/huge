<?php

/**
 * Created by PhpStorm.
 * User: Viktor Gobbi
 * Date: 02/04/16
 * Time: 1.49
 * Project: huge
 * File: Head.php
 */
class Head
{
    // Title

    public static function getTitle()
    {
        $title = Session::get('head_title');
        if (isset($title) && !empty($title))
            return $title;
        else
            return Config::get('DEFAULT_HEAD_TITLE');
    }

    public static function setTitle($title)
    {
        Session::set('head_title', $title);
    }

    public static function resetTitleToDefault()
    {
        Session::set('head_title', null);
    }

    // Icon

    public static function getIcon()
    {
        $icon = Session::get('head_icon');
        if (isset($icon) && !empty($icon))
            return $icon;
        else
            return Config::get('DEFAULT_HEAD_ICON');
    }

    public static function setIcon($icon)
    {
        Session::set('head_icon', $icon);
    }

    public static function resetIconToDefault()
    {
        Session::set('head_icon', null);
    }

    /**
     * Resets all overwritten values back to the default specified in the config file.
     */
    public static function resetHeaderToDefault()
    {
        self::resetTitleToDefault();
        self::resetIconToDefault();
    }
}