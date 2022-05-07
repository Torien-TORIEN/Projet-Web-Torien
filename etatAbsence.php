<?php
    session_start();
    @$debut=$_POST["debut"];
    @$fin=$_POST["fin"];
    @$classe=$_POST["classe"];
    @$valider=$_POST["valider"];
    if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
    }
    else{
      $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
      $_SESSION["classeS"]=$classe;
      $_SESSION["envoyer"]=$valider;
      $_SESSION["debut"]=$debut;
      $_SESSION["fin"]=$fin;
      //SPECIALE POUR OPTION DE SELECT
      include("connexion.php");
      $req="SELECT DISTINCT(nom) FROM groupe  order by nom ASC ";
      $reponse = $pdo->query($req);
      if($reponse->rowCount()>0) {
          $outputs["groupes"]=array();
      while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
              $etudiant = array();
              $etudiant["nom"] = $row["nom"];
              array_push($outputs["groupes"], $etudiant);
          }
          // success
          $outputs["success"] = 1;
      } else {
          $outputs["success"] = 0;
          $outputs["message"] = "Pas d'étudiants";}
        //SPECIALE POUR OPTION DE SELECT
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SCO-ENICAR Etat Absence</title>
        <!-- Bootstrap core CSS -->
        <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- Bootstrap core JS-JQUERY -->
        <script src="./assets/dist/js/jquery.min.js"></script>
        <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="./assets/jumbotron.css" rel="stylesheet">
        <style>
          #input{width:170px;}
        </style>

    </head>
    <body style="background-color:#DCDCDC;">
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
                
              
                  <form class="form-inline my-2 my-lg-0" id="myForm" action="chercherGroupe.php" method="POST">
                    <input class="form-control mr-sm-2" id="input" name="input" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="button" type="submit" >Chercher Groupe</button>
                  </form>
                </div>
              </nav>
              
        <main role="main">
            <div class="jumbotron" style="background-image:url('img/im2.jpg');text-align:center;border:10px solid black;border-radius:60px">
                <div class="container" style="color:white;border:10px solid grey;border-radius:50px">
                  <h1 class="display-4">État des absences pour un groupe</h1>
                  <p>Pour afficher l'état des absences, choisissez d'abord le groupe  et la periode concernée!</p>
                </div>
            </div>

            <div class="container" style=" border:10px none black;border-radius:30px">
              <form method="post" >
                    <table><tr><td>Date de début (j/m/a) : </td><td>
                      <input type="date" name="debut" id="debut" size="10"  class="datepicker"  required/>
                      </td></tr><tr><td>Date de fin : </td><td>
                      <input type="date" name="fin"  id="fin" size="10"  class="datepicker" required/>
                      </td></tr>
                    </table>

                  <div class="form-group">
                      <label for="classe">Choisir une classe:</label><br>
                      <select id="classe" name="classe" id="classe" class="custom-select custom-select-sm custom-select-lg">
                          <?php foreach($outputs["groupes"] as $tab): ?>
                              <option value="<?=$tab['nom']?>"><?=$tab['nom']?></option> 
                          <?php endforeach ?>
                      </select>
                  </div>
                  <button  type="button" class="btn btn-primary btn-block" name="valider" onclick="afficherAbs()">Afficher</button>
              </form>
              <div class="row"> 
                    <div class="table-responsive" id="demo" ></div>
              </div>
            </div>  
        </main>
<script>
    function afficherAbs(){
      var datedebut=$("#debut").val();
      var datefin=$("#fin").val();
      var classe=$("#classe").val();
      $.ajax({
        url:"etatabs.php",
        method:"post",
        data:{debut:datedebut,fin:datefin,classe:classe},
        success:function(data,status){
          console.log(data);
          $("#demo").html(data);
        }
      });
    }
    
</script>

    <footer class="container">
        <p>&copy; ENICAR 2021-2022</p>
    </footer>
</body>
</html>