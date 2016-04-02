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

    // Meta tags

    public static function getMetaTags()
    {
        $defaultTags = (array)Config::get('DEFAULT_HEAD_META');
        if (!empty(Session::get('head_metas')))
            $defaultTags = array_merge($defaultTags, Session::get('head_metas'));
        if (!empty(Session::get('head_metas_perm')))
            $defaultTags = array_merge($defaultTags, Session::get('head_metas_perm'));
        return $defaultTags;
    }

    public static function setMetaTags($tags)
    {
        if (!is_array($tags))
            $tags = array($tags);
        Session::set('head_metas', $tags);
    }

    public static function addMetaTags($tags)
    {
        if (empty(Session::get('head_metas')))
            return self::setMetaTags($tags);
        if (!is_array($tags))
            $tags = array($tags);
        Session::set('head_metas', array_merge(Session::get('head_metas'), $tags));
    }

    public static function resetMetaTags()
    {
        Session::set('head_metas', null);
    }

    public static function setPermanentMetaTags($tags)
    {
        if (!is_array($tags))
            $tags = array($tags);
        Session::set('head_metas_perm', $tags);
    }

    public static function addPermanentMetaTags($tags)
    {
        if (empty(Session::get('head_metas_perm')))
            return self::setPermanentMetaTags($tags);
        if (!is_array($tags))
            $tags = array($tags);
        Session::set('head_metas_perm', array_merge(Session::get('head_metas_perm'), $tags));
    }

    public static function resetPermanentMetaTags()
    {
        Session::set('head_metas_perm', null);
    }


    /**
     * Resets all overwritten values back to the default specified in the config file.
     */
    public static function resetHeaderToDefault()
    {
        self::resetTitleToDefault();
        self::resetIconToDefault();
        self::resetMetaTags();
    }
}