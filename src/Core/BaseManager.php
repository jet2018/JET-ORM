<?php

namespace Jet\Jet\Core;

use Jet\Jet\Config;
use Jet\Jet\Exceptions\DBException;
use Jet\Jet\Helpers\Helper;
use PDO;
use PDOException;


/**
 * Class BaseManager
 * @package Jet\Jet\Core
 * 
 * @author  Tumusiime Ezra Jet <
 * @version 1.0.0
 * 
 * Defines core methods for the Jet library, connection to the database, and other core methods
 */
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


    public function getConn()
    {
        $config = new Config();
        return $this->connection = $config->DATABASE;
    }

    public function validateConnection()
    {
        foreach ($this->connection as $conn => $value) {
            if ($conn === 'options') {
                continue;
            } else {
                if (!$this->is_string_and_not_null($value)) {
                    $message = "Error in your database connection: " . $conn . " can neither be empty nor non_string" . PHP_EOL;
                    $code = 12345;
                    throw new DBException($message, $code);
                    return false;
                } else {
                    return true;
                }
            }
        }
    }


    /**
     * @throws DBException
     */
    public function connect()
    {
        // validate all connection parameters except the options parameter
        try {
            $this->validateConnection();

            try {
                $conn = new PDO($this->connection['engine'] . ':host=' . $this->connection['server'] . ";dbname=" . $this->connection['database'], $this->connection['user'], $this->connection['password'], $this->connection['options']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                $message = "Connection failed: " . $e->getMessage();
                $code = $e->getCode();
                throw new DBException($message, $code);
            }
        } catch (DBException $e) {
            echo ("JETDBError: [" . $e->getCode() . "]::" . $e->getMessage());
        }
    }


    public function commit()
    {
        $this->connection->commit();
    }

    /**
     * Begins a transaction
     */
    public function begin()
    {
        return $this->connection->beginTransaction();
    }


    /**
     * Rolls back the transaction
     */
    public function rollback()
    {
        $this->connection->rollback();
    }

    public function query($sql, $params = null, $expects = 'many')
    {
        $this->begin(); // start a transaction
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
            // commit the transaction
            $this->commit();
            if ($expects === 'one') {
                return $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            // roll back the transaction
            $this->rollback();
            $message = "JETDBERROR: " . $e->getMessage() . PHP_EOL;
            $code = 12345;
            throw new DBException($message, $code);
        }
    }
}