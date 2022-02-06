<?php

namespace Jet\Jet\Core;

use Jet\Jet\Config;
use Jet\Jet\Exceptions\DBException;
use Jet\Jet\Helpers\Helper;
use PDO;

class BaseManager
{
    use Helper;
    /**
     * @var $connection holds the connection to the database
     */
    public $connection;

    public function __construct()
    {
        $this->getConn();
    }


    public function getConn(){
        $config = new Config();
        return $this->connection = $config->DATABASE;
    }

    function debugError($message, $type=0, $destination=null){
        return error_log($message=$message, $message_type=$type, $destination);
    }

    public function validateConnection(){
        foreach($this->connection as $conn => $value){
            if ($conn === 'options') {
                continue;
            }else{
                if(!$this->is_string_and_not_null($value)) {
                    $message = "Error in your database connection: ".$conn." can neither be empty nor non_string".PHP_EOL;
                    $code = 12345;
                    throw new DBException($message, $code);
                    return false;
                }else{
                    return true;
                }
            }
        }
    }


    /**
     * @throws DBException
     */
    public function connect(){
        // validate all connection parameters except the options parameter
        try{
            $this->validateConnection();

            try {
                $conn = new PDO($this->connection['engine'] . ':host=' . $this->connection['server'] . ";dbname=" . $this->connection['database'], $this->connection['user'], $this->connection['password'], $this->connection['options']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected to " . $this->connection['database'] . " successfully \n";
                return $conn;
            } catch (PDOException $e) {
                $message = "Connection failed: " . $e->getMessage();
                $code = $e->getCode();
                throw new DBException($message, $code);
            }
        }catch (DBException $e){
            echo("Error: [".$e->getCode()."]::".$e->getMessage());
        }


    }



}

