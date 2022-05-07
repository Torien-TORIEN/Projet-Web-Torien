<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
    else {
        include "connexion.php";
        $login=$_SESSION['login'];
        $dem="SELECT * from groupe where login='$login' order by nom ASC";
        $result = $pdo->query($dem);
        if($result->rowCount()>0){
            $table='<table class="table table-striped table-hover"><tr>';
            while ($row = $result ->fetch(PDO::FETCH_ASSOC)) {
                $nom=$row['nom'];
                $id=$row['id'];
                $table.='<td><button class="btn btn-primary" onclick="AfficherParGRP('.$id.')">'.$nom.'</button></td>';
            }
            $table.='</tr></table>';
            echo $table;
        }else{
          echo'<div class="alert alert-warning" role="alert"><h5 style="text-align:center;">Vous n\'avez pas encore de groupe</h5></div>';
          
        }
        
    }
?>