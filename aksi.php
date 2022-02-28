<?php
    if(isset($_GET['channel']) && isset($_GET['state'])){
        include 'connection.php';

        $state = $_GET['state'];
        $channel = $_GET['channel'];

        if($channel == '1'){
            mysqli_query($dbconnect, "UPDATE tb_iot SET ch1='$state'");
        }elseif ($channel == '2') {
            mysqli_query($dbconnect, "UPDATE tb_iot SET ch2='$state'");
        }elseif ($channel == '3') {
            mysqli_query($dbconnect, "UPDATE tb_iot SET ch3='$state'");
        }elseif ($channel == '4') {
            mysqli_query($dbconnect, "UPDATE tb_iot SET ch4='$state'");
        }
        header('location: device.php');
        exit;
    }

?>