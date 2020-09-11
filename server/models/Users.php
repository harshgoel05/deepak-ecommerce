<?php
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
REQUIRE_ONCE(__ROOT__.'/config/field-consts.php');
class Users extends Table
{
    public function insertRow($row)
    {
        $row[PASSWORD] = password_hash($row[PASSWORD], PASSWORD_DEFAULT);
        return parent::insertRow($row);
    }
    public function verifyPassword($username, $_password)
    {
        $row = $this->find([PASSWORD], "`username` = '{$username}'");
        if ($row->num_rows > 0)
            $hashedPassword = $row->fetch_assoc()[PASSWORD];
        else {
            return false;
        }
        return password_verify($_password, $hashedPassword);
    }
}
