<?php
   session_start();
   $erreur="";
   @$supprimer=$_GET["supprimer"];
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    if($_SESSION["supp"]=="not ok"){
        $erreur='<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ERROR 404 !</strong> CIN non trouvé , Veuillez saisir un CIN existant !
      </div>';}
    if ($_SESSION["supp"]=="ok"){
        $erreur='<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Notification :</strong> Un étudiant a été supprimé avec succes !
      </div>';}
      $_SESSION["supp"]="";//pour mettre la valeur de $erreur="" (vide)
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
          #input{width:190px;}
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
            <div class="jumbotron" style="background-image:url('img/im2.jpg')">
                <div class="container" style="color:red;text-align:center;border-style:groove;">
                  <h1 class="display-4">Supprimer un étudiant</h1>
                  <p>Taper le CIN d'étudiant à supprimer!</p>
                </div>
            </div>

      <div class="container">
        <!-- TRAVAILLER ICI-->
        <form action="SupprimerET.php" method="GET" id="myform">
          <div class="erreur"> <?php echo $erreur;?></div>
            <div class="form-group">
                <label for="cin">TAPER CIN:</label><br>
                <input type="text" id="cin" name="cin"  class="form-control" required pattern="[0-9]{8}" title="8 chiffres"/>
            </div>
            <!--Bouton Supprimer-->
            <button  type="submit" class="btn btn-primary btn-block" onclick="return confirm('Vous Voulez Vraiment Supprimer?')" name="supprimer">Supprimer</button>
        </form>
      <br>
      <div class="row">
        <div class="table-responsive" id="demo"> </div>
      </div>
      </div>
    </main>
    
    <script>
        $(document).ready(function(){
          refresh();
        });
        function refresh() {
            var xmlhttp = new XMLHttpRequest();
            var url = "http://localhost/Projet/afficherMesG.php";

          //Envoie de la requete
          xmlhttp.open("GET",url,true);
          xmlhttp.send();


        //Traiter la reponse
        xmlhttp.onreadystatechange=function()
                {  // alert(this.readyState+" "+this.status);
                    if(this.readyState==4 && this.status==200){
                    
                        myFunction(this.responseText);
                        //alert(this.responseText);
                        console.log(this.responseText);
                        //console.log(this.responseText);
                    }
                }


          //Parse la reponse JSON
          function myFunction(response){
            var obj=JSON.parse(response);
            //alert(obj.success);

            if (obj.success==1)
            {
          var arr=obj.etudiants;
          var i;
          var out="<table  border=1 class='table table-striped table-hover'> <tr><th>CIN</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Email</th><th>Classe</th><th>Action</th></tr>";
          for ( i = 0; i < arr.length; i++) {
            out+="<tr><td>"+
            arr[i].cin +
            "</td><td>"+
            arr[i].nom+
            "</td><td>"+
            arr[i].prenom+
            "</td><td>"+
            arr[i].adresse+
            "</td><td>"+
            arr[i].email+
            "</td><td>"+
            arr[i].classe+
            "</td><td>"+
            "<button class='btn btn-danger btn-block' type='button' name='button' onclick='deleteAjax("+arr[i].cin+")'>supprimer</button>"+
            "</td></tr>" ;
          }
          out +="</table>";
          document.getElementById("demo").innerHTML=out;
          }
          else document.getElementById("demo").innerHTML="Aucune Inscriptions!";

          }
      }
      function deleteAjax(id){
        if(confirm("Vous voulez supprimer cet etudiant don cin: "+id+" ?")){
          $.ajax({
            type:'post',
            url:'supprimer.php',
            data:{delete_id:id},
            success:function(data,status){
              $(id).hide();
              console.log(status);
              refresh();
            }
          });
        }
      }
    </script>
    <footer class="container">
        <p>&copy; ENICAR 2021-2022</p>
    </footer>
</body>
</html>
