<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc37beaf62e88fd7d4d22cec06f370058
{
    public static $classMap = array (
        'Cartthrob_shipping_usps' => __DIR__ . '/../..' . '/src/Cartthrob_shipping_usps.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitc37beaf62e88fd7d4d22cec06f370058::$classMap;

        }, null, ClassLoader::class);
    }
}
