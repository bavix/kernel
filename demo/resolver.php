<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

class Foo
{
    protected $name = 'foo';

    public function __construct($name = null)
    {
        if ($name)
        {
            $this->name = $name;
        }
    }
}

class Bar extends Foo
{
    protected $name = 'bar';
}

/**
 * Class Kernel
 *
 * @method Foo foo($name = null)
 * @method Bar bar($name = null)
 * @method Bar bar1($name = null)
 * @method Bar bar2($name = null)
 * @method Resolver resolver($name = null)
 */
class Resolver extends \Bavix\Kernel\Resolver
{

    protected $lumperMap = [
        'foo'  => Foo::class,
        'bar'  => Bar::class,
        'bar1' => Bar::class,
        'bar2' => Bar::class,
        'resolver' => Resolver::class
    ];

}

$resolver = new Resolver();

var_dump($resolver->foo());
var_dump($resolver->bar());
var_dump($resolver->bar());
var_dump($resolver->bar1());
var_dump($resolver->bar1('test1')); // bar
var_dump($resolver->bar2('test2'));

var_dump($resolver->resolver()->resolver()->resolver()->foo());
