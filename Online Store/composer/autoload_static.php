<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2fbf77fa96b02f9c900fb2f034835e40
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2fbf77fa96b02f9c900fb2f034835e40::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2fbf77fa96b02f9c900fb2f034835e40::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}