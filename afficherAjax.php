<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
    }
    else {
        extract($_POST);
        if(isset($classe) &&!empty($classe)){
            include("connexion.php");
            $req="SELECT * FROM etudiant where classe= '$classe' order by nom ASC";
            $reponse = $pdo->query($req);
            if($reponse->rowCount()>0) {
                $table='<div class="alert alert-success" style="text-align:center;"><h4>Les étudiants de : '.$classe.'</h4></div><br>';
                $table.='<table class="table table-striped"><tr class="thead thead-dark">
                        <th>CIN</th>
                        <th>Noms</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Email</th>
                        <th>Classe</th>
                        </tr>';
                
                while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
                        $cin= $row["cin"];
                        $nom = $row["nom"];
                        $prenom= $row["prenom"];
                        $adresse= $row["adresse"];
                        $email= $row["email"];
                        $classe= $row["Classe"];
                        $table.='<tr>
                                    <td>'.$cin.'</td>
                                    <td>'.$nom.'</td>
                                    <td>'.$prenom.'</td>
                                    <td>'.$adresse.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$classe.'</td>
                                </tr>';
                    }
                $table.='</table>';
                echo $table;
            } else {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>DESOLE ! </strong> Aucun étudiant de groupe : '.$classe.'  a été trouvé !
                </div>';
                
                }
        }
    }
?>
