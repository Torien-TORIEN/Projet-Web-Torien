<?php
    //Mirecupere tableau fo asany ty 
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
    else {
        include "connexion.php";
        if(isset($_POST['id'])) {
            $id=$_POST['id'];
            $req="SELECT * from etudiant where cin=$id";
            $result=$pdo->query($req);
            $reponse=array();
            while($row = $result ->fetch(PDO::FETCH_ASSOC) ){
                $reponse=$row;
            }
            echo json_encode($reponse);//convert to jason format
        }
        else{
            $reponse['status']=200;
            $reponse['message']="Pas d\'etudiant";
        }
        

    }
?>
    