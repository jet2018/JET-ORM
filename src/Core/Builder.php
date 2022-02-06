<?php

namespace Jet\Jet\Core;


trait Builder
{

    public function getDatabaseTables(){

    }

    public function generateTable(){

    }

    public function compareFields(){

    }

    public function createTableForFirstTime(){

    }

    public function createTableIfExists(){

    }

    public function updateColumn(){

    }

    public function calculateDifferenceBetweenMigrations(){

    }

    public function DropTable(){

    }

    public function TruncateTable(){

    }

    public function one(){
        return $this->fetchColumn();
    }

    public function all(){
        $this->fetchAll();
    }

    public function json(){
        return json_decode($this);
    }

    public function as_array(){
        return $this->all();
    }

}


// prepare a query
// bind params
//execute the query
