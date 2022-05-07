<?php
    session_start();
    include "testConnect.php";
    if(isset($_POST["stud_delete_multiple_btn"])){//isset(name_button)
        if(isset($_POST["stud_delete_id"])){
            $all_id=$_POST["stud_delete_id"];//$_POST["name_checkbox"]
            $extract_id=implode(',',$all_id);//Extract all checkboxs checked with separator ','
            //echo $extract_id;//to read what checkboxs are checked
            $query="DELETE FROM crud where id in ($extract_id)";
            $query_run=mysqli_query($con,$query);
            if($query_run){
                $_SESSION["status"]="Data Deleted Successfully !";
                header("location:testCheckbox.php");
            }else{
                $_SESSION["status"]="Data Not Deleted !";
                header("location:testCheckbox.php");
            }
        }else{
            $_SESSION["status"]="None Checked !";
            header("location:testCheckbox.php");
        }
    }
?>