<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitda5833837a443ab43c6031fd0270a039
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitda5833837a443ab43c6031fd0270a039::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitda5833837a443ab43c6031fd0270a039::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitda5833837a443ab43c6031fd0270a039::$classMap;

        }, null, ClassLoader::class);
    }
}
