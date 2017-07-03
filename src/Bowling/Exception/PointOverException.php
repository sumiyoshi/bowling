<?php

namespace Bowling\Exception;

class PointOverException extends \Exception
{
    public function __construct($message = 'Point is an illegal value', $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}