<?php

class CharField
{
    public function __construct($name, $length)
    {
        $this->name = $name;
        $this->length = $length;
    }
}

class Model
{
    function CharField(...$args)
    {
        $this->name = $args[0];
        $this->length = $args[1];
        return new CharField(...$args);
    }
}

class test extends Model
{
    public $name = CharField($length = '10');
    public $age = 12;
    public $email = ['helo', 'world'];
}

function create($cname)
{
    $vars = get_class_vars($cname);
    if (!$vars['table']) {
        $vars['table'] = $cname;
    }
    print_r($vars);
}

create('test');