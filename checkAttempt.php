<?php

    namespace validation;
    function GetUserIp()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        return $user_ip;
    }

    function CheckAttempt()
    {

    }

    #https://www.youtube.com/watch?v=obbtox2COsw&ab_channel=WebdesignemFoco
?>