<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }else{
    $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   
        if(date("H")<18)
        $bienvenue="Bonjour et bienvenue ".
        $_SESSION["prenomNom"].
        " dans votre espace personnel";
        else
        $bienvenue="Bonsoir et bienvenue ".
        $_SESSION["prenomNom"].
        " dans votre espace personnel";


       include('connexion.php');
       $login=$_SESSION["login"];
       $query="SELECT * FROM etudiant WHERE Classe in(select nom from groupe where nom LIKE 'INFO3%'AND login='$login')" ;
       $allGroups=$pdo->query($query);
   
   
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Afficher Etudiants</title>
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- Bootstrap core JS-JQUERY -->
        <script src="./assets/dist/js/jquery.min.js"></script>
        <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="./assets/jumbotron.css" rel="stylesheet">

    <style>
        #input{width:170px;}
            #search{
            
            padding:15px;
            border-radius: 10px;
            width:50%;
        }
                h1 {
                    border-bottom: 3px solid #1a2d53;
                    color: #1a2d53;
                    text-align:center;
                    font-size: 30px;
                }
                h4{
                    /*border-bottom: 3px solid #1a2d53;*/
                    color: #9aa153;
                    font-size: 20px;
                    text-align:center;
                    font:red;
                }
                /* table, th , td {
                    border: 1px solid grey;
                    border-collapse: collapse;
                    padding: 5px;
                }
                table tr:nth-child(odd) {
                    background-color: #f1f1f1;
                }
                table tr:nth-child(even) {
                    background-color: #ffffff;
                } */
    </style>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="index.php">SCO-Enicar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>        
            <div class="dropdown-menu" aria-labelledby="dropdown01">
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
      
        <form class="form-inline my-2 my-lg-0" id="myForm" action="chercherGroupe.php" method="POST">
            <input class="form-control mr-sm-2" id="input" name="input" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <button class="btn btn-outline-success my-2 my-sm-0" name="button" type="submit" >Chercher Groupe</button>
        </form>
      </div>
    </nav>
      
<main role="main">
        <div class="jumbotron" style="background-image:url('img/im4.jpg')">
            <div class="container">
                <br>
                <br>
                <button class="spinner-border spinner-grow-sm" id="anim1" style="width:16%;left:50px"><a href="info2.php" role="button" style="color:black;width:100%"></a></button>
                <h1><?= $bienvenue ?></h1>
              <h4 style="background-color:#EEE8AA">Tous vos étudiants de troisième année informatique :INFO3</h4>
              
            </div>
          </div>

  <div class="container">
      <div class="row">
      <div class="table-responsive bouton" style="text-align:center">
          <button class="btn btn-success" id="info1" style="width:16%"><a href="info1.php" role="button" style="color:white;width:100%">Voir aussi INFO1 &raquo;</a></button>
          <button class="btn btn-info" id="info2" style="width:16%"><a href="info2.php" role="button" style="color:white">Voir aussi INFO2 &raquo;</a></button>
        </div>
        <div class="table-responsive"> 
                <br>
                  <?php 
                    if($allGroups->rowCount()>0){
                      ?>
                      
                      <br>
                      <table class='table table-striped table-hover'>
                          <!-- <th> -->
                          <tr>
                          <th>CIN</th>
                          <th>NOM</th>
                          <th>prenom</th>
                          <th>email</th>
                          <th>adresse</th> 
                          <th>classe</th>
                  </tr>
                  <!-- </th>
                  <td> -->
                      <?php
                      while($row = $allGroups ->fetch(PDO::FETCH_ASSOC)){
                        /* $cin=$row['cin'];
                          $nom=$row['nom'];
                          $prenom=$row['prenom'];
                          $email=$row['email'];
                          $adresse=$row['adresse']; */
                        

                    
                      ?>
                        <tr>
                          <td><?php echo $row["cin"];?> </td>
                              <td><?php echo $row["nom"];?> </td>
                              <td><?= $row["prenom"];?> </td>
                              <td><?php echo $row["adresse"];?> </td>
                              <td><?php echo $row["email"];?> </td>
                              <td><?php echo $row["Classe"];?> </td>
                      <?php
                      }
                      ?>
                  <!-- </td> -->
                  </table>
                  <?php

                  }else{
                      echo "<div class='alert alert-danger' role='alert'><h5 class='text-danger text-center mt-3'>Aucun étudiant de INFO3</h5></div>";
                  }
              }
              ?>
        </div>
      </div>
  </div>
</body>
</html>
