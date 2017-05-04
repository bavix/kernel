<?php

namespace Bavix\Kernel;

use Bavix\Exceptions;

final class Common
{

    /**
     * Common constructor.
     *
     * @throws Exceptions\Invalid
     */
    public function __construct()
    {
        throw new Exceptions\Invalid(__CLASS__);
    }

    /**
     * @param string $name
     * @param mixed  $mixed
     *
     * @return void
     */
    public static function bind($name, $mixed)
    {
        Resolver::sharedInstance()
            ->bind($name, $mixed);
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, array $arguments)
    {
        return Resolver::sharedInstance()
            ->{$name}(...$arguments);
    }

}
