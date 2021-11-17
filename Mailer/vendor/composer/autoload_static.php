<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitebe677889508c6a1af0f1bc33ecb192a
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitebe677889508c6a1af0f1bc33ecb192a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitebe677889508c6a1af0f1bc33ecb192a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitebe677889508c6a1af0f1bc33ecb192a::$classMap;

        }, null, ClassLoader::class);
    }
}
