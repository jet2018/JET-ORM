<?php

require  __DIR__ . '/vendor/autoload.php';

use Jet\Jet\Application;
use Jet\Jet\Config;
use Jet\Jet\Migrator;



$mg = new Migrator\Calculator();
$data = "<?php namespace JET\JET\Migrations; \n public class SomeClass(){\n print(\"Hello world \") \n}";
$mg->write_file('STudent', $data);