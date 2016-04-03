<?php

/**
 * Created by PhpStorm.
 * User: Viktor Gobbi
 * Date: 03/04/16
 * Time: 3.46
 * Project: huge
 * File: ReCaptcha.php
 */
class Captcha
{
    public static function getCaptchaType()
    {
        if (Config::get('RECAPTCHA_ENABLED') && !empty(Config::get('RECAPTCHA_SITE_KEY')) && !empty(Config::get('RECAPTCHA_SECRET_KEY')))
            return 'reCAPTCHA';
        else
            return 'image';
    }

    public static function getCaptchaHtml()
    {
        if (self::getCaptchaType() === 'reCAPTCHA')
            return self::getReCaptchaTag();
        else
            return self::getImageCaptcha();
    }

    private static function getReCaptchaTag()
    {
        return '<div class="g-recaptcha" data-sitekey="' . Config::get('RECAPTCHA_SITE_KEY') . '"></div>
                <script src=\'https://www.google.com/recaptcha/api.js?hl=' . Config::get('RECAPTCHA_LANG') . '\'></script>';

    }

    private static function getImageCaptcha()
    {
        return '<!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag -->
                <img id="captcha" src="' . Config::get('URL') . 'register/showCaptcha" />
                <input type="text" name="captcha" placeholder="Please enter above characters" required />
                <!-- quick & dirty captcha reloader -->
                <a href="#" style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center"
               onclick="document.getElementById(\'captcha\').src = \'' . Config::get('URL') . 'register/showCaptcha?\' + Math.random(); return false">Reload Captcha</a>';
    }

    public static function verifyCurrentReCaptcha()
    {
        if (self::getCaptchaType() === 'reCAPTCHA') {
            $recaptcha = new \ReCaptcha\ReCaptcha(Config::get('RECAPTCHA_SECRET_KEY'));
            $resp = $recaptcha->verify(Request::post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
            return $resp->isSuccess();
        } else {
            return CaptchaModel::checkCaptcha(Request::post('captcha'));
        }
        //$errors = $resp->getErrorCodes();
    }
}