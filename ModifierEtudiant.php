<?php
   session_start();
   $erreur="";
   @$modifier=$_POST["modifier"];
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    if($_SESSION["modifier"]=="not ok"){
        $erreur='<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ERROR 404 !</strong> CIN non trouvé ,Tapez un autre CIN .
      </div>';}
    if ($_SESSION["modifier"]=="ok"){
        $erreur='<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Excellent !</strong> La modifacation est bien réussie !
      </div>';} 
     $_SESSION["modifier"]="";//pour mettre la valeur de $erreur="" (vide)

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
          <div class="jumbotron" style="background-image:url('img/im6.jpg')">
              <div class="container" style="text-align:center;border-style:dashed;border-radius:30px">
                <h1 class="display-4">Modifier un Etudiant</h1>
                <p>Saisir son identifiant pour modifier!</p>
              </div>
          </div>

    <div class="container">
        <!-- TRAVAILLER ICI-->
        <form action="Modifier.php" method="post">
        <div class="erreur"> <?php echo $erreur;?></div>
            <div class="form-group">
                <label for="cin">TAPER CIN:</label><br>
                <input type="text" id="cin" name="cin"  class="form-control" placehoder="Entrer CIN" required pattern="[0-9]{8}" title="8 chiffres"/>
            </div>
            <!--Bouton Ajouter-->
            <button  type="submit" class="btn btn-primary btn-block" name="modifier" >Modifier</button>
        </form>
        <br>
    <div class="row">
      <div class="table-responsive" id="demo"> </div>
    </div>
    </div>
  </main> 

          <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabeindex="-1" role="dialog" aria-labelledby="exampleModaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <!--CIN-->
                  <div class="form-group">
                      <label for="cin">CIN:</label><br>
                      <input type="text" id="cinUpdate" name="cin" readonly="readonly" class="form-control" required pattern="[0-9]{8}" title="8 chiffres"/>
                  </div>
                    <!--Nom-->
                  <div class="form-group">
                      <label for="nom">Nom:</label><br>
                      <input type="text" id="nom" name="nom" class="form-control" required autofocus>
                  </div>
                  <!--Prénom-->
                  <div class="form-group">
                      <label for="prenom">Prénom:</label><br>
                      <input type="text" id="prenom" name="prenom" class="form-control" required>
                  </div>
                  <!--Email-->
                  <div class="form-group">
                      <label for="email">Email:</label><br>
                      <input type="email" id="email" name="email" class="form-control" required>
                  </div>
                  <!--Password-->
                  <div class="form-group">
                      <label for="pwd">Mot de passe:</label><br>
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
                    <select  id="classe" name="classe"  class="custom-select custom-select-sm custom-select-lg">
                          <?php foreach($outputs["groupes"] as $tab): ?>
                              <option value="<?=$tab['nom']?>"><?=$tab['nom']?></option> 
                          <?php endforeach ?>
                    </select>
                  </div> 
                  <!--Adresse-->
                  <div class="form-group">
                      <label for="adresse">Adresse:</label><br>
                      <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="Modifier()"  >Enresgistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal" data-backdrop="static"> Add new user </button> -->

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
        "<button class='btn btn-warning btn-block' type='button' name='button' onclick='UpdateDetails("+arr[i].cin+")'>Modifier</button>"+
        "</td></tr>" ;
      }
      out +="</table>";
      document.getElementById("demo").innerHTML=out;
       }
       else document.getElementById("demo").innerHTML="Aucune Inscriptions!";

      }
    }
  function UpdateDetails(id){
      $("#cinUpdate").val(id);
      $.post("ModifierEtdAjax.php",{id:id},function(data,status){
        var userid=JSON.parse(data);
        $('#nom').val(userid.nom);
        $('#prenom').val(userid.prenom);
        $('#email').val(userid.email);
        //$('#pwd').val(userid.password);
        //$('#cpwd').val(userid.cpassword);
        $('#classe').val(userid.Classe);
        $('#adresse').val(userid.adresse);
      });
      $("#updateModal").modal("show");  
  }
  function Modifier(){
    var id=$("#cinUpdate").val();
    var nom=$("#nom").val();
    var prenom=$("#prenom").val();
    var email=$("#email").val();
    var pwd=$("#pwd").val();
    var cpwd=$("#cpwd").val();
    var adresse=$("#adresse").val();
    var classe=$("#classe").val();
    if(nom!='' &&prenom!='' &&email!='' &&pwd!=''  &&cpwd!='' &&adresse!=''){
      if(cpwd==pwd && pwd.length>7){
        var regex=/^\w+([\.-]w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(email.match(regex)){
          $.post("ModifierEtd.php",{
            id:id,
            nom:nom,
            prenom:prenom,
            email:email,
            pwd:pwd,
            cpwd:cpwd,
            adresse:adresse,
            classe:classe
          },function(data,status){
              console.log(status);
              console.log(data);
              $("#updateModal").modal('hide');//to hide Modal
              refresh();
              alert("Modification avec success !"); 
          });
        }else{
          alert(" Email invalide !")
        }
      }
      else{
        alert("Veuillez vérifier les mots de passes :Au moins 8 caratères !");
      }
    }
    else{
      alert("Tout le champ est obligatoire!");
    }
  }
</script>

  <footer class="container">
      <p>&copy; ENICAR 2021-2022</p>
    </footer>
</body>
</html> 
