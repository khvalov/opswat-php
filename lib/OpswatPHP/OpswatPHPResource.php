<?php

namespace OpswatPHP;

abstract class OpswatPHPResource extends OpswatPHPObject
{
    /**
     * @param string $class
     * @return string
     */
    public static function className($class)
    {
        // Strip namespace if present
        if ($postfix = strrchr($class, '\\')) {
            $class = substr($postfix, 1);
        }
        if (substr($class, 0, strlen('OpswatPHP')) == 'OpswatPHP') {
            $class = substr($class, strlen('OpswatPHP'));
        }
        $class = str_replace('_', '', $class);
        $class = substr($class, 0, 1) . preg_replace("/([A-Z])/", "_$1", substr($class, 1)); // Camel -> snake
        $name = urlencode($class);
        $name = strtolower($name);

        return $name;
    }

    /**
     * @param string $class
     * @return string
     */
    public static function classUrl($class)
    {
        $className = self::className($class);
        if (substr($className, -1) !== "s" && substr($className, -1) !== "h") {
            return "/{$className}s";
        }

        return "/{$className}es";
    }

}
