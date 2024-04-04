<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite45fe23be5e07c291351e12b760b1129
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInite45fe23be5e07c291351e12b760b1129', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite45fe23be5e07c291351e12b760b1129', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite45fe23be5e07c291351e12b760b1129::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
