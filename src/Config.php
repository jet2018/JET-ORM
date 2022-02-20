<?php

namespace Jet\Jet;

class Config
{
public  $BASE_URL = __DIR__;

public $DATABASE = [
    'server' => 'localhost',
    'user' => "root",
    'password' => 'peacebewithyouall2020',
    'database' => "blogdb",
    'engine' => 'mysql', // can pgsl, mysql, sqlite, etc
    'options' => [], // edit this to add any pdo configurations you would wsh to use.
];




}
