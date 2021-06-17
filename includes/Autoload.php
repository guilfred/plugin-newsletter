<?php

namespace App;

/**
 * Class Autoload
 *
 * Instanciate concrete class
 */
class Autoload
{
    const EXT = '.php';


    public static function load(): bool
    {
        return \spl_autoload_register([__CLASS__, 'register']);
    }

    /**
     * @param string $classeName
     */
    private static function register(string $classeName)
    {
        if (strpos($classeName, __NAMESPACE__) === 0) {
            $classeName = str_replace(__NAMESPACE__.'\\', '', $classeName);
            $classeName = str_replace('\\', '/', $classeName);

            require $classeName.self::EXT;
        }
    }

}
