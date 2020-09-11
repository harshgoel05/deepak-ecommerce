<?php
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/database/DB.php');

class Table
{
    public $name;
    public $cols;
    public $extras;

    function __construct($_name = null, $_cols = null, $_extras = null)
    {
        $this->name = $_name;
        $this->cols = $_cols;
        $this->extras = $_extras;
    }

    public function create()
    {
        return DB::createTable($this->name, $this->cols, $this->extras);
    }

    private function filterKeys($row) {
        $filteredRow = [];
        foreach($row as $key => $value)
        {
            if(array_key_exists($key,$this->cols))
            {
                $filteredRow[$key] = $value;
            }
        }
        return $filteredRow;
    }
    
    public function insertRow($row)
    {
        $filteredRow = $this->filterKeys($row);
        return DB::insertRow($this->name,$filteredRow);
    }

    public function find($col_names,$query)
    {
        return DB::find($this->name,$col_names,$query);
    }

    public function findById($col_names=NULL,$_id)
    {
        return $this->find($col_names,"`id` = {$_id}");
    }

    protected function validateRow($row)
    {
        if(array_key_exists('email',$row))
        {
            $row['email'] = filter_var($row['email'],FILTER_VALIDATE_EMAIL);
            if($row['email'] === false)
            {
                return false;
            }
        }
        return true;
    }

    public function drop()
    {
        return DB::drop($this->name);
    }

}
