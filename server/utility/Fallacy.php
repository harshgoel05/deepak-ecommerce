<?php
namespace Utility;
require_once(__DIR__.'/../config/other-configs.php');

class Fallacy
{
    private $message,$type;

    public function __construct($_type='null',$_message='null')
    {
        $this->type = $_type;
        $this->message = $_message;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getMessage()
    {
        return $this->message;
    }
}