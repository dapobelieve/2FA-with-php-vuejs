<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/17/2019
 * Time: 8:03 AM
 */

require_once ('config.php');

class MySQLDatabase
{

    private $connection;
    /**
     * hold the value of a previously ran query
     * @var [type]
     */
    private $lastQuery;

    public function __construct()
    {
        $this->openConnection();
    }

    public function openConnection()
    {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {
        if (isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function query($sql)
    {
        $this->lastQuery = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirmQuery($result);
        return $result;
    }

    public function fetchArray($result)
    {
        return mysqli_fetch_array($result);
    }

    public function numRows($result)
    {
        return mysqli_num_rows($result);
    }

    public function insertId()
    {
        return mysqli_insert_id($this->connection);
    }

    public function affectedRows()
    {
        return mysqli_affected_rows($this->connection);
    }

    /**
     * Confirm a query result
     * @param  array $queryResult [result of a query]
     * @return boolean
     */
    private function confirmQuery($queryResult)
    {
        if (!$queryResult){
            $output = 'Database Query failed: '. mysqli_error($this->connection).'<hr> <br>';
            $output .= 'Last SQL Query: '.$this->lastQuery;
            die($output);
        }
    }

    public function prepare()
    {
        //
    }

    // Check if email exists
    public function checkIfEmailExists($email)
    {
        $this->openConnection()->prepare("SELECT * FROM tbl_patients WHERE email = '$email' LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            return "Email already exist. Please use another email";
        }
    }
}