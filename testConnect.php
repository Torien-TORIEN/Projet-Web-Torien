<?php 
                //  server     user   password database-name
    $con=new mysqli('localhost','root','','bootstrapcrud');
    if(!$con){
        die(mysqli_error($con));
    }
?> 