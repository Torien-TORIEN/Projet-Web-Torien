<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
    else {
        include("connexion.php");
        extract($_POST);
        $login=$_SESSION['login'];
        $dem="SELECT nom from groupe where id=$id and login='$login' order by nom ASC";
        $result = $pdo->query($dem) or die("ERROR");
        $gp = $result ->fetch(PDO::FETCH_ASSOC);
        $groupe=$gp['nom'];
        $req="SELECT * from etudiant where classe='$groupe' order by nom ASC ";
        $reponse = $pdo->query($req) or die("ERROR");
        if($reponse->rowCount()>0){
            //echo $groupe;
            $table='<br><div class="alert alert-primary"> <h4 style="text-align:center">
                    Etudiants de groupe : '.$groupe.'</h4></div>  <br>';
            $table.='<table  border=1 class="table table-striped table-hove"> <tr>
            <th>CIN</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Classe</th></tr>';
            while($row = $reponse ->fetch(PDO::FETCH_ASSOC)){
                $table.='<tr><td>'.$row['cin'].'</td>
                    <td>'.$row['nom'].'</td>
                    <td>'.$row['prenom'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['adresse'].'</td>
                    <td>'.$row['Classe'].'</td></tr>';
            }
            $table.='</table>';
            echo $table;
        }else{ 
            echo '<div class="alert alert-warning" role="alert"><h4 style="text-align:center;">Aucun étudiant de ce groupe: '.$groupe.'</h4></div>';
        }
    }
    
?>
