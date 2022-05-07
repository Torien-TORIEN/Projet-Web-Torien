<?php
    //data returned is always something that we do in echo here
    // echo data_callback;
    include "testConnect.php";
    if(isset($_POST['updateid'])){
        $user_id=$_POST['updateid'];
        $sql="SELECT * from  crud where id=$user_id";
        $result=mysqli_query($con,$sql);
        $response=array();
        while($row=mysqli_fetch_assoc($result)){
            $response=$row;
        }
        echo json_encode($response);//convert to jason format

    }else{
        $response['status']=200;
        $response['message']='Iinvalid or data not found!';
        echo json_encode($response);
    }


    //Update query
    if(isset($_POST['hiddendata'])){
        $uniqueid=$_POST['hiddendata'];
        $name=$_POST['updatename'];
        $email=$_POST['updatemail'];
        $mobile=$_POST['updatemobile'];
        $place=$_POST['updateplace'];
        $sql="UPDATE crud set name='$name' ,email='$email', mobile='$mobile', place='$place' where id=$uniqueid ";
        $result=mysqli_query($con,$sql); 
    }
?> 