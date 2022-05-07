<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
@$cin=$_REQUEST['cin'];
$_SESSION['cin']=$cin;
@$_SESSION['url']="http://localhost/Projet/ModifierEtudiant.php";


include("connexion.php");
         $sel=$pdo->prepare("select cin from etudiant where cin=?");
         $sel->execute(array($cin));
         $tab=$sel->fetchAll();
         if(count($tab)==0){
           // $erreur="NOT OK";// Etudiant existe déja
            @$_SESSION["modifier"]="not ok";
            header("location:ModifierEtudiant.php");
         }
         else{
            $sel=$pdo->prepare("select * from etudiant where cin=?");
            $sel->execute(array($cin));
            //$erreur ="OK";
            @$_SESSION["modifier"]="ok";
             //SPECIAL POUR SELECT OPTION
             $login=$_SESSION['login'];
            $req="SELECT nom FROM groupe where login='$login' order by nom ASC ";
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
            echo('<!DOCTYPE html>
            <html lang="en">
            <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>SCO-ENICAR Ajouter Etudiant</title>
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
                    <div class="jumbotron" style="background-image:url(\'img/im6.jpg\')">
                        <div class="container" style="text-align:center;border:10px solid grey;border-radius:30px">
                          <h1 class="display-4">Modifier un étudiant</h1>
                          <p>Remplir le formulaire ci-dessous afin de modifier  un étudiant!</p>
                        </div>
                      </div>
            
            
            <div class="container">
             <form id="myform" method="GET" action="Update.php">
                 <!--CIN-->
                 <div class="form-group">
                 <label for="cin">CIN:</label>
                <label  class="form-control">'.$cin.'</label>
                
                </div>
                 <!--Nom-->
                 <div class="form-group">
                 <label for="nom">Nouveau Nom:</label><br>
                 <input type="text" id="nom" name="nom" class="form-control" required autofocus>
                </div>
                 <!--Prénom-->
                 <div class="form-group">
                 <label for="prenom">Nouveau Prénom:</label><br>
                 <input type="text" id="prenom" name="prenom" class="form-control" required>
                </div>
                 <!--Email-->
                 <div class="form-group">
                    <label for="email">Nouveau Email:</label><br>
                    <input type="email" id="email" name="email" class="form-control" required>
                   </div>
                 <!--Password-->
                 <div class="form-group">
                 <label for="pwd">Nouveau Mot de passe:</label><br>
                 <input type="password" id="pwd" name="pwd" class="form-control"  required pattern="[a-zA-Z0-9]{8,}" title="Au moins 8 lettres et nombres"/>
                </div>
                <!--ConfirmPassword-->
                <div class="form-group">
                    <label for="cpwd">Confirmer Mot de passe:</label><br>
                    <input type="password" id="cpwd" name="cpwd" class="form-control"  required/>
                </div>
                 <!--Classe-->
                 <div class="form-group">
                 
                 <label for="classe">Classe:</label><br>
                 <select  id="classe" name="classe"  class="custom-select custom-select-sm custom-select-lg">');
                        foreach($outputs["groupes"] as $tab): 
                          echo' <option value='.$tab["nom"].'>'.$tab["nom"].'</option> ';
                       endforeach ;
                echo(' </select>

                </div>
                 <!--Adresse-->
                 <div class="form-group">
                 <label for="adresse">Nouveau Adresse:</label><br>
                 <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required>
                 </textarea>
                </div>
                 <!--Bouton Ajouter-->
                 <button  type="submit" class="btn btn-primary btn-block" name="ajouter">Enregistrer</button>
            
            
             </form> 
            </div>  
            </main>
            
            
            <footer class="container">
                <p>&copy; ENICAR 2021-2022</p>
              </footer>
            
            <script  src="./assets/dist/js/inscrire.js"></script>
            </body>
            </html>');
            //header("location:ModifierEtudiant.php");
         }  
         //echo $erreur;
}


?>
