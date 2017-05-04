<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

use Bavix\Kernel\Common;

Common::bind('pow', 'pow');

var_dump(Common::pow(2, 10));
