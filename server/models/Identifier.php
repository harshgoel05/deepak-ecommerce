<?php
namespace Models;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
require_once(__ROOT__ . '/config/field-consts.php');
require_once(__ROOT__.'/utility/CustomErrors.php');

class Identifier extends Table
{
    protected $identifierCol=null;

    public function insertRow($row,$isUser = 1)
    {
        if (!$this->validateRow($row, [$this->identifierCol, 'password',])) {
            return 'Validation error';
        }
        if($row[PASSWORD] !== $row['confirm_password'])
        {
            \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,"Password and confirm password do not match");
        }
        if (isset($row[PASSWORD]))
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
}
