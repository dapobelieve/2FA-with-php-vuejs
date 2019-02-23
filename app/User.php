<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/17/2019
 * Time: 8:08 AM
 *
 * for methods popularly used by users
 */


require_once 'MySQLDatabase.php';


class User extends MySQLDatabase
{
    public function create ($array)
    {
        $array['password'] = md5($array['password']);
        $fields =  "`".implode("`, `", array_keys($array))."`";

        $values = "'".implode("',  '", array_values($array))."'";

//        return $values;

        $query = "INSERT INTO user ($fields)";
        $query .= "VALUES ($values)";

        $result1 = $this->query($query);
    }


    public function checkMailExists($email)
    {
        $sql = "SELECT email from user WHERE email = '$email'";

        $result = $this->query($sql);

        return $this->numRows($result);
    }
}