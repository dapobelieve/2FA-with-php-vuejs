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

    private $smsUsername = 'citieclik@gmail.com';
    private $smsPassword = 'citieclik01';
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

        $htmlContent = '<!DOCTYPE html5>
                        <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no maximum-scale=1">
                                <title>Crescendo Bank</title>
                            </head>
                        
                            <body>
                        <div style="width: 90%; margin-left: auto; margin-right: auto; background-color: #fff;">
                            <p>Hi there, you recently registered on our portal, click the link to verify your account
                            </p>
                            <a target="_blank" href='.$link.'>Verify my account</a>
                            <p>If the link doesnt open, copy and paste the url below in your browser..</p>
                            <pre>'.$link.'</pre>
                       </div>
                        </body> 
                        </html>';

        $htmlContent = stripslashes($htmlContent);


        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("noreply@crescendobank.com", "Crescendo Bank");
        $email->setSubject("Email Verification ");
        $email->addTo($result['email'], "Example User");

        $email->addContent("text/html", $htmlContent);

        $sendGrid = new \SendGrid($this->apiKey);

        try {
            $response = $sendGrid->send($email);
             if($response->statusCode() === 202){
                 return true;
            }

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

    public function sendToken($phone)
    {
        $code = mt_rand(10000, 99999) ."-". mt_rand(100, 999);
        $client = new GuzzleHttp\Client();
        $message = "Your token is ".$code;
        $number  = $phone;

        $response = $client->post('http://portal.bulksmsnigeria.net/api/?', [
            'verify'    =>  false,
            'form_params' => [
                'username' => $this->smsUsername,
                'password' => $this->smsPassword,
                'message' => $message,
                'sender' => 'Crescendo',
                'mobiles' => $number
            ],
        ]);


        $response = json_decode($response->getBody(), true);



    }
}