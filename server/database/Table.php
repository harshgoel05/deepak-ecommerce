<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/database/DB.php');

class Table {
    public $name;
    public $cols;
    public $extras;

    function __construct($_name=null,$_cols=null,$_extras=null) 
    {
        $this->name = $_name;
        $this->cols = $_cols;
        $this->extras = $_extras;
    }

    public function create()
    {
        return DB::createTable($this->name,$this->cols,$this->extras);
    }
}