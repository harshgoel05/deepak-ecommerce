<?php
namespace Models;
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
require_once(__ROOT__.'/config/field-consts.php');
require_once(__ROOT__.'/database/db-connection.php');
require_once(__ROOT__.'/models/Identifier.php');

class Users extends Identifier
{
    
    
    public function getProfile($identifier)
    {
        global $db;
        $identifier = $db->escape_string($identifier);
        $res = $this->findAllExceptGivenCols(['user_id',PASSWORD],USER_IDENTIFIER." = '{$identifier}'");
        if($res->num_rows > 0)
            return $res->fetch_assoc();
        else return false;
    }
}
