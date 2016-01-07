<?php

namespace AppBundle\Util\Inflector;

use FOS\RestBundle\Util\Inflector\InflectorInterface;

class NoInflector implements InflectorInterface
{
    public function pluralize($word)
    {
        return $word;
    }

}