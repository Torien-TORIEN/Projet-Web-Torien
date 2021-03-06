<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
    }
    $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
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
          .erreur{
          color:red;
          }
          #demo{
            color:red;
          }
          #input{width:170px;}
          .row button{  width:50%;position:inline-block;}
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
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les ??tudiants</a>
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
                <a class="dropdown-item" href="etatAbsence.php">??tat des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se D??connecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form class="form-inline my-2 my-lg-0" id="myForm" action="chercherGroupe.php" method="POST">
            <input class="form-control mr-sm-2" id="input" name="input" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <button class="btn btn-outline-success my-2 my-sm-0" name="button" type="submit" >Chercher Groupe</button>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron" style="background-image:url('img/im1.jpg')">
            <div class="container " style=" color:yellow;border-style: outset;">
              <h1 class="display-4" style="text-align:center">Chercher Un etudiant</h1>
              <p style="text-align:center">Saisir son CIN puis Chercher!</p>
            </div>
        </div>

        <div class="container">
            <!-- TRAVAILLER ICI-->
            <form action="" method="GET" id="myform">
                  <div class="form-group">
                      <div id="saisir"></div>
                      <input type="search" id="cin" name="cin"  class="form-control" placeholder="Entrez CIN" autocomplete="off" required pattern="[0-9]{8}" title="8 chiffres"/>
                      <br>
                      <div  id="search" style='text-align:center;'></div>
                  </div>
            </form>
        </div>
        <div class="row">
            
        </div>
</main>

<script>
    $(document).ready(function(){
        $("#cin").keyup(function(){
            var input=$(this).val();
            //alert(input);
            if(input !=""&& input !="'"){
                $.ajax({
                    url:"chercherEt.php",
                    type:"GET",
                    data:{input:input},
                    success:function(data){
                        $("#search").html(data);
                    }
                });
            }else{
                document.getElementById('search').innerHTML="Aucun Etudiant Correspondant";
                document.getElementById('search').style.color='green';
            }
        });
    });
</script>

<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>