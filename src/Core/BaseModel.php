<?php

namespace Jet\Jet\Core;

use PDO;

class BaseModel extends BaseManager
{
    /**
     * @var $model_name holds table name
     */
    public $table;

    public function __construct($model_name = null)
    {
        $model_name ? $this->table = $model_name : self::class;
    }

    public function structure()
    {

        $statement = $this->conn->query('DESCRIBE ' . $this->table);
        $structure = $statement->fetchAll(PDO::FETCH_ASSOC);
        $columns = array();
        foreach ($structure as $field) {
            $columns[$field['Field']] = $field['Field'] . '=>' . "[
                'type'=> " . $field['Type'] . ", 'Null'=> " . $field['Null'] . ", 'Key'=> " . $field['Key'] . ", 'Default'=> " . $field['Default'] . ", 'Extra'=> " . $field['Extra'] . " ]";
        }
        return $columns;
    }
}