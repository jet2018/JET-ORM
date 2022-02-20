<?php

namespace Jet\Jet\Migrator;
use Jet\Jet\Config;

/**
 * Calculate the difference between two models
 */
class Calculator extends Config
{
    public function __construct(){
        $config = new Config();
        $this->directory = $config->BASE_URL.'/migrations';
    }
    public $EVENTS = [
        'FRESH'=>'fresh',
        'CHANGETABLENAME'=>'change_table_name',
        'CHANGEFIELDNAME'=>'change_field_name',
        'CHANGEFIELDBODY'=>'change_field_body',
        'DROPCOLUMN'=>'drop_column',
        'ADDCOLUMN'=>'add_column',
        'DROPTABLE'=>'drop_table',
        'ADDTABLE'=>'add_a_table',
        'ADDFK'=>'add_fk',
        'DROPFK'=>'drop_fk',
        'CHANGEFK'=>'change_fk',
        'ADDINDEX'=>'add_index',
        'DELETEINDEX'=>'delete_index',
        'CHANGEINDEX'=>'change_index',
    ];


    function create_folder($dir =Null ){
        if ($dir){
            $directory = $dir;
        }else{
            $directory = $this->directory;
        }
        #...................................
        #...................................
        if (is_dir($directory)){
            return $directory;
        }
        mkdir($directory);
        return $directory;
    }

    function create_file($name, $dir=Null){
        $file = touch($this->create_folder($dir).'/'.$name);
        return $file;
    }

    function write_file($table_name, $data){
        $file_name = strtolower($table_name . '-' . time() . '.php');
        file_put_contents($this->create_folder().'/'.$file_name, $data);
        return $file_name;
    }
}



