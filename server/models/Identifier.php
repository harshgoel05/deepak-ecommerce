<?php

namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/config/field-consts.php');
require_once(__ROOT__ . '/utility/autoloader.php');
require_once(__ROOT__ . '/utility/CustomErrors.php');

class Identifier extends Table
{
    protected $identifierCol = null;

    public function insertRow($row, $extra = null)
    {
        $err = $this->validateRow($row, [$this->identifierCol, 'password',]);
        if ($err instanceof Fallacy) {
            return $err;
        }
        if ($row[PASSWORD] !== $row['confirm_password']) {
            return new Fallacy(\Utility\CustomErrors::VALUE_ERROR, "Password and confirm password do not match");
        }
        $row[PASSWORD] = password_hash($row[PASSWORD], PASSWORD_DEFAULT);
        return parent::insertRow($row, $extra);
    }

    public function verifyPassword($identifier, $_password)
    {
        $identifier = $this->dbObj->escape_string($identifier);
        $row = $this->find([PASSWORD], "`" . $this->identifierCol . "` = '{$identifier}'");
        if ($row->num_rows > 0)
            $hashedPassword = $row->fetch_assoc()[PASSWORD];
        else {
            return false;
        }
        return password_verify($_password, $hashedPassword);
    }

    public function getProfile($id)
    {
        $identifier = $this->dbObj->escape_string($id);
        $res = $this->findAllExceptGivenCols(['id', PASSWORD], SESSION_IDENTIFIER . " = '{$id}'");
        if ($res->num_rows > 0)
            return $res->fetch_assoc();
        else return null;
    }

    protected function validateRow($row, $colNames = null)
    {
        $err = parent::validateRow($row, $colNames);
        if ($err instanceof Fallacy) {
            return $err;
        }
        $err = array();
        if (array_key_exists('email', $row)) {
            $row['email'] = filter_var($row['email'], FILTER_VALIDATE_EMAIL);
            if ($row['email'] === false) {
                return new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::invalidValueMessage('email'));
            }
        }
        return true;
    }

    public function getId($identifier)
    {
        $identifer = $this->dbObj->escape_string($identifier);
        $res = $this->find(['id'], $this->identifierCol . " = '{$identifier}' ");
        if ($res->num_rows > 0) {
            return $res->fetch_assoc()['id'];
        }
        return null;
    }

    public function updateProfile($identifer, $row)
    {
        $identifer = $this->dbObj->escape_string($identifer);
        $condition = SESSION_IDENTIFIER . " = {$identifer}";

        if(array_key_exists(PASSWORD,$row))
        {
            $row[PASSWORD] = password_hash($row[PASSWORD],PASSWORD_DEFAULT);
        }

        $temp_res = $this->update($row, $condition);
        if (!($temp_res instanceof Fallacy)) {
            if ($temp_res >= 0)
                return true;
            else
                return false;
        } else {
            return $temp_res;
        }
    }
}
