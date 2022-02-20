<?php

namespace Jet\Jet\Core;


trait Builder
{

    public function getDatabaseTables()
    {
    }

    public function generateTable()
    {
    }

    public function compareFields()
    {
    }

    public function createTableIfNotExists()
    {
    }

    public function createTableIfExists()
    {
    }

    public function updateColumn(string $col, array $new_struct)
    {
    }

    public function tableStatus()
    {
    }

    public function DropTable()
    {
    }

    public function TruncateTable()
    {
    }

    public function returnOne()
    {
        $this->fetchOne();
    }

    public function one()
    {
        return $this->fetchColumn();
    }

    public function all()
    {
        $this->fetchAll();
    }

    public function classParams()
    {
        return get_class_vars(get_class($this));
    }


    public function json()
    {
        return json_decode($this);
    }

    public function as_array()
    {
        return $this->all();
    }
}


// prepare a query
// bind params
//execute the query

/**
 * example of a query
 * class Student extends Model
 *  {
 *     $first_name = $this->ForeignKeyField( $unique = true, $nullable = false, $default = null, $length = 255, $type = 'varchar', $table = 'students', $column = 'first_name', $on_delete = 'cascade', $on_update = 'cascade' );
 *    $last_name =  ForeignKeyField( $unique = true, $nullable = false, $default = null, $length = 255, $type = 'varchar', $table = 'students', $column = 'last_name', $on_delete = 'cascade', $on_update = 'cascade' );
 *   $age =  IntegerField( $unique = false, $nullable = false, $default = null, $length = 11, $type = 'int', $table = 'students', $column = 'age', $on_delete = 'cascade', $on_update = 'cascade' );
 * }
 *  
 
 