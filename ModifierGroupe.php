<?php
   session_start();
   $erreur="";
   @$supprimer=$_GET["supprimer"];
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   if($_SESSION["modG"]=="not ok"){
     
        $erreur='<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ALERT !</strong> Echec de modification !
      </div>';}
    if ($_SESSION["modG"]=="ok"){
    $erreur='<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Notification : </strong> Vous avez modifié votre groupe avec succes !
  </div>';}
        $_SESSION["modG"]="";//pour mettre la valeur de $erreur="" (vide)
    //SPECIAL POUR SELECT OPTION
    include("connexion.php");
    $login=$_SESSION["login"];
    $req="SELECT * FROM groupe where login='$login' order by nom ASC ";
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
    //SPECIAL POUR SELECT OPTION
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
            position:center;
          }
          #input{width:170px;}
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
        
      
          <form class="form-inline my-2 my-lg-0" id="myForm" action="chercherGroupe.php" method="POST">
              <input class="form-control mr-sm-2" id="input" name="input" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
              <button class="btn btn-outline-success my-2 my-sm-0" name="button" type="submit" >Chercher Groupe</button>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron" style="background-image:url('img/im5.jpg')">
            <div class="container" style="color:yellow;text-align:center;">
              <h1 class="display-4" style="border:12px solid grey;border-radius:30px">Modifier un Groupe</h1>
            </div>
          </div>

          <div class="container">
    <!-- TRAVAILLER ICI-->
    <form action="ModifierG.php" method="GET" id="myform">
    <div class="erreur"> <?php echo $erreur;?></div>
            <form action="ModifierG.php" method="GET"  >
                <div class="form-group">
                    <label for="classe">Groupe à modifier:</label><br>
                    <select  id="classe" name="classe"  class="custom-select custom-select-sm custom-select-lg">
                        <?php foreach($outputs["groupes"] as $tab): ?>
                            <option value="<?=$tab['nom']?>"><?=$tab['nom']?></option> 
                        <?php endforeach ?>
                    </select>
                    <label for="Nclasse">Nouveau Groupe:</label><br>
                    <input type="text" id="Nclasse" name="Nclasse" class="form-control" required pattern="INFO[1-3]{1}-[A-E]{1}"
                    title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
                   <button  type="submit" class="btn btn-primary btn-block" name="modifier">modifier</button>
                </div>
            </form>
    </form>
</div>

</main>
<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>
<?php $erreur="";?>
