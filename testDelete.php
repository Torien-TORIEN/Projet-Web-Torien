<?php
    include "testConnect.php";
    if(isset($_POST['deleteSend'])){
        $effacer=$_POST['deleteSend'];
        $sql="DELETE from crud where id=$effacer";
        $result=mysqli_query($con,$sql);
    }
?>