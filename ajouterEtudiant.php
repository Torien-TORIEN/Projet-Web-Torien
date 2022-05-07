<?php
   session_start();
   $erreur="";
   @$ajouter=$_POST["ajouter"];
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   else{
    $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    if($_SESSION["ajout"]=="not ok"){
        $erreur='<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Alert !</strong> Cet étudiant existe déjà dans, Veuillez vérifier le CIN !
      </div>';
      }
    if ($_SESSION["ajout"]=="ok"){
        $erreur='<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Bravo !</strong> Un étudiant a été ajouté avec success !
                </div>';
    }
     $_SESSION["ajout"]="";//pour mettre la valeur de $erreur="" (vide)
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
  }
?>
<!DOCTYPE html>
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
          #btn_ajout{
            top:10px;
            text-align:center;
            /* margin-right:200px; */
            margin-left:350px;
            width:400px;
            height:50px;
          }
          .titre{
            border-style: double;
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
        <div class="jumbotron" style="color:white;background-image:url('img/im5.jpg')" >
            <div class="container ">
              <div class="titre">
              <h1 class="display-4 " style="text-align:center">Ajouter un étudiant</h1>
              <p style="text-align:center">Remplir le formulaire ci-dessous afin d'ajouter un étudiant OU Clicquer sur ce boutton ci-dessous!</p>
              </div><br>
              <button type ="button"  class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal" id="btn_ajout" data-backdrop="static" >
                <span class="spinner-grow spinner-grow-sm"></span>
                Ajouter..
              </button>
            </div>
          </div>


<div class="container">
 <form id="myForm" method="POST" action="ajouter.php" >
     <!--
                        TODO: Add form inputs
                        Prenom - required string with autofocus
                        Nom - required string
                        Email - required email address
                        CIN - 8 chiffres
                        Password - required password string, au moins 8 letters et chiffres
                        ConfirmPassword
                        Classe - Commence par la chaine INFO, un chiffre de 1 a 3, un - et une lettre MAJ de A à E
                        Adresse - required string
                    -->
    
    <?php echo $erreur;?>
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
     <!--CIN-->
     <div class="form-group">
     <label for="cin">CIN:</label><br>
     <input type="text" id="cin" name="cin"  class="form-control" required pattern="[0-9]{8}" title="8 chiffres"/>
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
      <!-- <div class="form-group">
      <label for="classe">Classe:</label><br>
      <input type="text" id="classe" name="classe" class="form-control" required pattern="INFO[1-3]{1}-[A-E]{1}"
      title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
    </div> -->
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
     <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required>
     </textarea>
    </div>
     <!--Bouton Ajouter-->
     <button  type="submit" class="btn btn-primary btn-block" name="ajouter">Ajouter</button>
     <!-- <button type="button" onclick="ajouter()">Ajouter</button> -->


 </form> 
</div>  
</main>

              <!--  Modal Pour Ajouter -->
    <div class="modal fade" id="ajoutModal" tabeindex="-1" role="dialog" aria-labelledby="exampleModaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Model pour l'Ajout !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <!--CIN-->
                  <div class="form-group">
                      <label for="cina">CIN:</label><br>
                      <input type="text" id="cina" name="cina"  class="form-control" required pattern="[0-9]{8}" title="8 chiffres"/>
                  </div>
                    <!--Nom-->
                  <div class="form-group">
                      <label for="noma">Nom:</label><br>
                      <input type="text" id="noma" name="noma" class="form-control" required autofocus>
                  </div>
                  <!--Prénom-->
                  <div class="form-group">
                      <label for="prenoma">Prénom:</label><br>
                      <input type="text" id="prenoma" name="prenoma" class="form-control" required>
                  </div>
                  <!--Email-->
                  <div class="form-group">
                      <label for="emaila">Email:</label><br>
                      <input type="email" id="emaila" name="emaila" class="form-control" required>
                  </div>
                  <!--Password-->
                  <div class="form-group">
                      <label for="pwda">Mot de passe:</label><br>
                      <input type="password" id="pwda" name="pwda" class="form-control"  required pattern="[a-zA-Z0-9]{8,}" title="Au moins 8 lettres et nombres"/>
                  </div>
                  <!--ConfirmPassword-->
                  <div class="form-group">
                      <label for="cpwda">Confirmer Mot de passe:</label><br>
                      <input type="password" id="cpwda" name="cpwda" class="form-control"  required/>
                  </div>
                  <!--Classe-->
                  <div class="form-group">
                    <label for="classea">Classe:</label><br>
                    <select  id="classea" name="classea"  class="custom-select custom-select-sm custom-select-lg">
                          <?php foreach($outputs["groupes"] as $tab): ?>
                              <option value="<?=$tab['nom']?>"><?=$tab['nom']?></option> 
                          <?php endforeach ?>
                    </select>
                  </div> 
                  <!--Adresse-->
                  <div class="form-group">
                      <label for="adressea">Adresse:</label><br>
                      <textarea id="adressea" name="adressea" rows="10" cols="30" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="ajouterAjax()"  >Ajouter</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal" data-backdrop="static"> Add new user </button> -->



<div id="demo"></div>
<script>

    function ajouterAjax(){
      var cin =$("#cina").val();
      var nom =$("#noma").val();
      var prenom =$("#prenoma").val();
      var classe =$("#classea").val();
      var email =$("#emaila").val();
      var adresse =$("#adressea").val();
      var pwd=$("#pwda").val();
      var cpwd=$("#cpwda").val();
      if(cin!='' && nom!='' && prenom!='' && email!='' && classe!='' && pwd!='' && cpwd!='' && adresse!='' ){
        var regex=/^\w+([\.-]w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;//tester email
        if(email.match(regex)){
            if(pwd==cpwd && pwd.length>7){
              var re = /^-?\d\d*$/;//tester un entier
              if(cin.match(re) && cin.length==8){
                $.ajax({
                  url:"ajouterAjax.php",
                  type:"post",
                  data:{
                    cin:cin,
                    nom:nom,
                    prenom:prenom,
                    adresse:adresse,
                    classe:classe,
                    pwd:pwd,
                    cpwd:cpwd,
                    email:email
                  },
                  success:function(data,status){
                    console.log(status);
                      if(data=="NO"){
                        alert("CIN EXISTE DEJA !");
                      }else{
                        $("#ajoutModal").modal('hide');
                        alert(data);
                      }
                  }
                });


              }else{alert("CIN est à 8 chiffres !");}
            }else{alert("Mots de Passe différents ou Moins de 8 caractères !");}
        }else{alert(" Email Non valide !");}
      }else{alert("Tous les champs sont obligatoires !");}
      
    }
    function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/Projet/ajouter.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

        form=document.getElementById("myForm");
        formdata=new FormData(form);

        xmlhttp.send(formdata);

        //Traiter Res

        xmlhttp.onreadystatechange=function()
            {   
                if(this.readyState==4 && this.status==200){
                 alert(this.responseText);
                    if(this.responseText=="OK")
                    {
                        document.getElementById("demo").innerHTML="L'ajout de l'étudiant a été bien effectué";
                        document.getElementById("demo").style.backgroundColor="green";
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML="L'étudiant est déjà inscrit, merci de vérifier le CIN";
                        document.getElementById("demo").style.backgroundColor="#fba";
                    }
                }
            }
        
        
    }
    
</script>
<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>

<script  src="./assets/dist/js/inscrire.js"></script>
</body>
</html>