<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/20/2019
 * Time: 10:21 AM
 */

class Response
{

    /**
     * Response constructor.
     * @param Boolean $status
     * @param array $data
     * @param String $message
     */
    public function respond($status, $data=[], $message)
    {
        $res = [
            'status' => $status,
            'data'   => $data,
            'message' => $message
        ];
        return json_encode($res);
    }
}

$res = new Response();