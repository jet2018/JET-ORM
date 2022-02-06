<?php

namespace Jet\Jet\Helpers;

trait Helper
{
    public function is_string_and_not_null($string){
        return !is_string($string) || !empty($string);
    }

    public function now(){
        $date = new \DateTime();
        return $date->getTimestamp();
    }
}