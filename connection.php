<?php

    $dbhost = 'localhost';
    $dbuser = 'id18993645_ubb';
    $password = 'BisaBisa100@Ya';
    $dbname = 'id18993645_iotubb';

    $dbconnect = new mysqli($dbhost, $dbuser, $password, $dbname);

    if($dbconnect->connect_error){
        die('Server Bermasalah');
    }



?>