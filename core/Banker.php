<?php include 'Hash.php'; ?>
<?php

/**
* Banker Classs
* Dapo Believe
*/
class Banker
{
    private $userId;
    private $balance;
    private $fname;
    private $lname; 
    private $accountNumber;
    private $currency = '&#x20A6;';
    private $userTable = 'users';
    
    function __construct($con, $user_id)
    {
        $sql = "SELECT * 
                FROM $this->userTable
                WHERE $this->userTable.id = '$user_id' ";

        $query = mysqli_query($con, $sql)or die (mysqli_error($con));

        $userData = mysqli_fetch_object($query);
        
        $this->userId = $userData->id;
        $this->balance = $userData->balance;
        $this->fname = $userData->fname;
        $this->lname = $userData->lname;
        $this->accountNumber = $userData->account;
        $this->connect = $con;
    }

    // public function getFullName()
    // {
    //     return ucfirst($this->fname)." ".ucfirst($this->lname);
    // }

    public function getBalance($account)
    {
        $sql = "SELECT * 
                FROM users
                WHERE account = '$account'
                ";
        $query = mysqli_query($this->connect, $sql) or die (mysqli_error($this->connect));

        $userData = mysqli_fetch_object($query);

        return $userData->balance;
    }

    public function transfer($sender, $amount, $reciever, $desc = '' ){
        //deduct from sender
        $sqlSender = "UPDATE $this->userTable 
                SET balance = balance - $amount 
                WHERE account = '$sender' ";
        $querySender = mysqli_query($this->connect, $sqlSender)or die(mysqli_error($this->connect));

        //add to reciever
        $sqlReciever = "UPDATE $this->userTable 
                SET balance = balance + $amount 
                WHERE account = '$reciever' ";

        $queryReciever = mysqli_query($this->connect, $sqlReciever)or die(mysqli_error($this->connect));

        $sName = $this->getFullName($sender);
        $rName = $this->getFullName($reciever);

        $sId = $this->getUserId($sender);
        $rId = $this->getUserId($reciever);

        $sMsg = "Cash Deposit for ".$desc;
        $rMsg = "Account credited from ".$sName."for ".$desc;

        //log transaction twice
        //senders
        $this->logTrxn($sName, $amount, $sId, $reciever, 'D', $sMsg);

        //recievers
        $this->logTrxn($rName, $amount, $rId, $sender, 'C', $rMsg);
    }

    public function getHistory($account){
        $output = array();
        $id = $this->getUserId($account);
        $sql = "SELECT * 
                FROM logs
                WHERE user_id = '$id' 
                ";

        $query = mysqli_query($this->connect, $sql);
        $x = 1;

        while ($data = mysqli_fetch_object($query)) {
            $amt = number_format($data->amount);
            $output[] = array(
                'key'      => $x,
                'amount'   => $amt,
                'type'     => $data->type,
                'account'  => $data->account,
                'name'     => $data->name,
                'details'  => $data->details,
                'trxn_ref' => $data->trxn_ref,
                'date'     => $data->created_at
            );

            $x++;
        }

        $res = array(
            'status'  => 1,
            'recs'    => $output,
            'msg'     => 'Found'
        );

        return json_encode($res);
    }

    public function withDraw($amount, $acNumber, $name)
    {
        $sql = "UPDATE $this->userTable 
                SET balance = balance - $amount 
                WHERE account = '$acNumber' ";
        $query = mysqli_query($this->connect, $sql)or die(mysqli_error($this->connect));

        $userId = $this->getUserId($acNumber);

        $this->logTrxn($name, $amount, $userId, $acNumber, 'W', 'Withdrawal');
    }

    public function checkAccountNumber($acn)
    {
        $sql = "SELECT * 
                FROM users
                WHERE account = '$acn'
                ";
        $query = mysqli_query($this->connect, $sql) or die (mysqli_error($this->connect));
        if(mysqli_num_rows($query) == 1){
            return true;
        }else{
            return false;
        }
    }

    public function deposit($amount, $acNumber, $name)
    {
        $sql = "UPDATE $this->userTable 
                SET balance = balance + $amount 
                WHERE account = '$acNumber' ";
        $query = mysqli_query($this->connect, $sql)or die(mysqli_error($this->connect));

        $userId = $this->getUserId($acNumber);

        $this->logTrxn($name, $amount, $userId, $acNumber, 'D', 'Cash Deposit');
    }

    private function logTrxn($name, $amount, $userId, $account, $type, $details)
    {
        $ref = TransRef::getHashedToken();
        $sql = "INSERT INTO logs (name, amount, user_id, account, type, details, trxn_ref) VALUES ('$name','$amount','$userId', '$account', '$type', '$details', '$ref')";
        $query = mysqli_query($this->connect,$sql)or die(mysqli_error($this->connect));
    }

    public function getUserId($accountNum)
    {
        $sql = "SELECT * 
                FROM users
                WHERE account = '$accountNum'
                ";
        $query = mysqli_query($this->connect, $sql) or die (mysqli_error($this->connect));

        $userData = mysqli_fetch_object($query);
        return $userData->id;
    }

    public function getFullName($accountNum)
    {
        $sql = "SELECT * 
                FROM users
                WHERE account = '$accountNum'
                ";
        $query = mysqli_query($this->connect, $sql) or die (mysqli_error($this->connect));

        $userData = mysqli_fetch_object($query);
        return $userData->fname." ".$userData->lname;
    }
}