<?php
    include "testConnect.php";
    extract($_POST);//this is extract (data) all variables in data instead  using for example $name=$_POST['name']
    if( isset($_POST['nameSend'])&& isset($_POST['emailSend']) && isset($_POST['mobileSend']) && isset($_POST['placeSend'])){
        $sql="INSERT into crud (name ,email, mobile, place) values('$nameSend','$emailSend','$mobileSend','$placeSend') ";
        $result=mysqli_query($con,$sql) ;//or die("ERROR ");
       // header("location:saisir.php");
        echo $nameSend." ".$emailSend." ".$mobileSend." ".$placeSend;
    }
    else{
        echo "NO";
        //header("location:testAjax.php");
    }
?>