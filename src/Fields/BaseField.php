<?php

namespace Jet\Jet\Fields;
use Jet\Jet\Exceptions\FieldException;
use Jet\Jet\Helpers\Helper;

trait BaseField
{
    public $length;
    public $pk;
    public $fk;
    public $unique;
    public $default;
    public $null;


    public $types = [
        'CharField' => 'VARCHAR',
        'IntegerField' => 'INT',
        'FloatField'=>'float',
        'TextField'=>'TEXT',
        'DateTimeField'=>'DATETIME',
        'DateField' => 'DATE',
        'SmallIntField'=>'SMALLINT',
        'LargeTextField' => 'TEXT',
        'SmallTextField' => 'MEDIUMTEXT',
        'JsonField' => 'JSON',
        'ForeignKeyField' => 'INT',
        'PrimaryKeyField' => 'INT'
    ];

    public function getFieldName(){
        return self::class;
    }

    public function getType(){
        return $this->types[$this->getFieldName()];
    }


    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->getType().'('.$length.')';
        $this->length = $length;
    }

    public function auto_increment(){
        if($this->getType() === 'INT'){
            return ' AUTO INCREMENT ';
        }else{
            throw new FieldException('Only Integers can be auto increment', 12345);
        }
    }

    public function setUnique(){
        return $this->unique = ' UNIQUE ';
    }

//    public function auto_now_add(){
//        return $this->default = $this->getType() == 'DATETIME' ? 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP' : 'NULL';
//    }
//
//    public function auto_now(){
//        return $this->default = 'CURRENT_TIMESTAMP';
//    }



}