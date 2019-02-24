<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/17/2019
 * Time: 8:08 AM
 *
 * for methods popularly used by users
 */

require '../vendor/autoload.php';
require_once 'MySQLDatabase.php';
require_once  ('../core/Hash.php');

class User extends MySQLDatabase
{
    private $apiKey = "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";
    public function create($array)
    {
        $fields =  "`".implode("`, `", array_keys($array))."`";

        $values = "'".implode("',  '", array_values($array))."'";

        $query = "INSERT INTO user ($fields)";
        $query .= "VALUES ($values)";

        $result1 = $this->query($query);

        //call method to send email
        $this->sendEmailVerify($this->insertId());

        return true;
    }


    public function checkMailExists($email)
    {
        $sql = "SELECT email from user WHERE email = '$email'";

        $result = $this->query($sql);

        return $this->numRows($result);
    }

    public function checkPhoneExists($email)
    {
        $sql = "SELECT phone from user WHERE phone = '$email'";

        $result = $this->query($sql);

        return $this->numRows($result);
    }

    private function sendEmailVerify($userId)
    {
        $verifyHash = $this->getHash();

        $this->createToken($userId, $verifyHash);

        $sql = "SELECT email from user WHERE id = '$userId'";
        $result = $this->fetchArray($this->query($sql));

        $link = $_SERVER['HTTP_REFERER']."#verify-email/".$verifyHash;

        $htmlContent = '<div style="width: 90%; margin-left: auto; margin-right: auto; background-color: #fff;">
                            <p style="font-size: 24px">Hi there, you recently registered on our portal, click the link to verify your account
                             <a href="'.$link.'">Verify my account</a></p>
                       </div>';



        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("noreply@crescendobank.com", "Crescendo Bank");
        $email->setSubject("Email Verification ");
        $email->addTo('dapomichaels@gmail.com', "Example User");

        $email->addContent("text/html", $htmlContent);

        $sendGrid = new \SendGrid($this->apiKey);

        try {
            $response = $sendGrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        }catch (Exception $e) {
            echo "Caught Exception: ".$e->getMessage()." ,";
        }

    }

    private function  createToken($id, $token)
    {
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tokens (`user_id`, `token`, `sent_at`)";
        $sql .= "VALUES ('$id', '$token', NOW())";

        $result = $this->query($sql);

        return true;

    }

    private function getHash()
    {
        $hash = new Hasher();
        return $hash->getHashedToken();
    }
}