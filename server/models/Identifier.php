<?php
namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
require_once(__ROOT__ . '/config/field-consts.php');
require_once(__ROOT__.'/utility/CustomErrors.php');

class Identifier extends Table
{
    protected $identifierCol=null;

    public function insertRow($row)
    {
        $err = $this->validateRow($row, [$this->identifierCol, 'password',]); 
        if ($err instanceof Fallacy) {
            \Utility\HttpErrorHandlers\badRequestErrorHandler($err->getType(),$err->getMessage());
        }
        if($row[PASSWORD] !== $row['confirm_password'])
        {
            \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,"Password and confirm password do not match");
        }
        $row[PASSWORD] = password_hash($row[PASSWORD], PASSWORD_DEFAULT);
        return parent::insertRow($row);
    }

    public function verifyPassword($identifier, $_password)
    {
        $identifier = $this->dbObj->db->escape_string($identifier);
        $row = $this->find([PASSWORD], "`" . $this->identifierCol . "` = '{$identifier}'");
        if ($row->num_rows > 0)
            $hashedPassword = $row->fetch_assoc()[PASSWORD];
        else {
            return false;
        }
        return password_verify($_password, $hashedPassword);
    }

    public function getProfile($identifier)
    {
        $identifier = $this->dbObj->escape_string($identifier);
        $res = $this->findAllExceptGivenCols(['id',PASSWORD],$this->identifierCol." = '{$identifier}'");
        if($res->num_rows > 0)
            return $res->fetch_assoc();
        else return null;
    }

    protected function validateRow($row,$colNames=null)
    {
        $err = parent::validateRow($row,$colNames);
        if($err instanceof Fallacy)
        {
            return $err;
        }
        $err = array();
        if(array_key_exists('email',$row))
        {
            $row['email'] = filter_var($row['email'],FILTER_VALIDATE_EMAIL);
            if($row['email'] === false)
            {
                return new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::invalidValueMessage('email'));
            }
        }
        return true;
    }
}
