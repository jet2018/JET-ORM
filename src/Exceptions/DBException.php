<?php

namespace Jet\Jet\Exceptions;


class DBException extends \Exception
{
    public $message;
    public $code;

    public function __construct($message, $code = 0, \Exception $old = null)
    {
        parent::__construct($message, $code, $old);
    }

    public function __toString() {
        return 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$this->getMessage();
    }
}