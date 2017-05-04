<?php

namespace Bavix\Kernel;

use Bavix\Exceptions;
use Bavix\Foundation\SharedInstance;
use Bavix\Lumper\Lumper;

class Resolver
{

    // used in Common Class
    use SharedInstance;

    /**
     * @var Lumper
     */
    protected $lumper;

    /**
     * @var array
     */
    protected $lumperMap = [];

    /**
     * @return Lumper
     */
    protected function lumper()
    {
        if (!$this->lumper)
        {
            $this->lumper = new Lumper();
        }

        return $this->lumper;
    }

    /**
     * @param string   $name
     * @param mixed    $mixed
     *
     * @return $this
     */
    public function bind($name, $mixed)
    {
        $this->lumperMap[$name] = $mixed;

        return $this;
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     *
     * @throws Exceptions\NotFound\Data
     */
    public function __call($name, array $arguments)
    {
        return $this->lumper()->once(function () use ($name, &$arguments)
        {

            if (!isset($this->lumperMap[$name]))
            {
                throw new Exceptions\NotFound\Data('Lumper map-object `' . $name . '` not found');
            }

            $mixed = $this->lumperMap[$name];
            unset($this->lumperMap[$name]);

            if (is_callable($mixed))
            {
                return $mixed(...$arguments);
            }

            return new $mixed(...$arguments);

        }, $name);
    }

}
