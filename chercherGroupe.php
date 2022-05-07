<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
    
    else {
      
        $groupe=$_REQUEST['input'];
        @$bouton=$_REQUEST['button'];
        
        echo $bouton;
        include("connexion.php");
        if(isset($_REQUEST['button'])){
            

            if($groupe!=''){
                $req="SELECT DISTINCT(nom) from groupe where nom LIKE '%$groupe%' order by nom ASC";
                $reponse=$pdo->query($req);
                if($reponse->rowCount()>0){
                    //TABLEAU DE GROUPE 
                    $gp='<p style="text-align:center;border-style:outset;">Cliquer sur le bouton pour afficher les étudiants correspondants!</p><br>
                            <table class="table table-striped"><tr style="text-align:center">';
                    while($tab = $reponse ->fetch(PDO::FETCH_ASSOC)){
                        $nom=$tab["nom"];
                        //Selectionner le 1er id  du groupe $nom pour le passer en parametre 
                        //dans la fonction onclick de chaque bouton groupe car si on passe $nom en parametre ça ne marchera pas 
                        $query="SELECT id from groupe where nom ='$nom' limit 1";
                        $res=$pdo->query($query);
                        $tab_id = $res ->fetch(PDO::FETCH_ASSOC);
                        $id=$tab_id['id'];
                        $gp.='<td><button type="button" class="btn btn-primary" onclick="AfficherParGRP('.$id.')">'.$nom.'</button></td>';
                    }
                    $gp.='</tr></table>';
                    // Selectionner étudiants de groupe saisi dans le formulaire 
                    $sql="SELECT * from etudiant where Classe LIKE '%$groupe%' order by Classe and nom";
                    $result=$pdo->query($sql);
                    if($result->rowCount()>0){
                        //Afficher les étudiants 
                        $titre='<div class="alert alert-success"><h4 style="text-align:center">Resultats pour le groupe recheché : '.$groupe.' </h4></div><br>';
                        $table=$titre.'<table class="table table-striped table-hover">
                            <tr>
                                <th>CIN</th>
                                <th>Noms</th>
                                <th>Prenom</th>
                                <th>Adresse</th>
                                <th>Email</th>
                                <th>Classe</th>
                            </tr>';
                        while ($row = $result ->fetch(PDO::FETCH_ASSOC)) {
                            $table.='<tr>
                                <td>'.$row["cin"].'</td>
                                <td>'.$row["nom"].'</td>
                                <td>'.$row["prenom"].'</td>
                                <td>'.$row["adresse"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["Classe"].'</td>

                            </tr>';
                        }
                        $table.='</table>';
                    }
                    else{
                        //Tsisy etudiant de ce groupe
                        $table='<div class="alert alert-warning">
                                <h4 style="text-align:center">Aucun etudiant du groupe : '.$groupe.'</h4>
                                </div>';
                    }
                }
                else{
                    //Tsy hita anatiny base de donnée le groupe
                    $table='<div class="alert alert-danger">
                                <h4 style="text-align:center">Aucun  groupe comme : '.$groupe.'</h4>
                                </div>';
                    
                }

            }
            else{
                // Tsisy raha ni-saisisserny
                // $table='<div class="alert alert-danger">
                //                 <h4 style="text-align:center">Vous avez rien Saisi !</h4>
                //                 </div>';
                $table='<script> alert("Vous avez Rien Saisi")</script>';
                $url=$_SESSION['url'];
                header("location:$url");
                
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Chercher Groupe</title>
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
    <style>
      #input{width:170px;}
      #idem{
        background-color:grey;
        background-image:url(immg\b1.jpg);
      }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="AjouterGroupe.php">Ajouter Groupe</a>
                <a class="dropdown-item" href="ModifierGroupe.php">Modifier Groupe</a>
                <a class="dropdown-item" href="SupprimerGroupe.php">Supprimer Groupe</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="ChercherEtudiant.php">Chercher Etudiant</a>
                <a class="dropdown-item" href="ModifierEtudiant.php">Modifier Etudiant</a>
                <a class="dropdown-item" href="SupprimerEtudiant.php">Supprimer Etudiant</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <button class="btn btn-outline-success my-2 my-sm-0" name="bouton" type="button" onclick="retour()">Previous</button>
            <button class="btn btn-outline-success my-2 my-sm-0" name="bouton" type="button"><a href="index.php">Aceuil</a></button>
          
        </div>
      </nav>
      
    <main role="main">
            <div class="jumbotron" style="background-image:url('img/im5.jpg');color:white">
                <div class="container">
                <h1 class="display-4" style="text-align:center;border-style:inset;">Liste des Groupes Trouvés</h1>
                <?=@$gp;?>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="table-responsive" id="demo"><?=@$table;?></div>
                    
                </div>
            </div>

    </main>
    <div class="container">
          <div class="row">
              <div class="table-responsive" id="idem">peace&reg;</div>
          </div>
    </div>

    <script>
      function retour(){
        alert("RETOUR");
      }
      function AfficherParGRP(id){
        $.ajax({
            url:"chercherGrp.php",
            method:"post",
            data:{id:id},
            success:function(data,status){
              console.log(status);
              console.log(data);
              $("#demo").html(data);
            }
          });
      }
    </script>
    
</body>
</html>