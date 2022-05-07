<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"];
      //" dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
      //ACTUALITE INFO1
      $actu11="<p style='color:green'>INFO1-A</p>:&nbsp;La séance de rattrapage de Analyse Numérique est prévu le 5/05/2022 à 11:20-12:35 dans la salle s23";
      $actu12="";
      $actu13="";
      //ACTUALITE INFO2
      $actu21="<p style='color:red'>Appel à la Compétition</p>:&nbsp; Pour ceux qui sont intérressés pour la compétition Web veuillez nous contacter par email";
      $actu22="<p style='color:red'>Avis pour tous les etudiants de 2e année </p>:&nbsp; Veillez Consulter votre email pour remplir le formulaire envoyé. ";
      $actu23="";
      //ACTUALITE INFO3
      $actu31="<p style='color:blue'>Avis à tous les étudiants de 3e Année</p>:&nbsp;    Le rapport de Stage de PFE doit etre pret avant le mois de Juillet";
      $actu32="";
      $actu33="";
?>    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Walid SAAD">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR</title>
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      /*Ajouter fond image dynamique*/
      .jumbotron{
        background-image:url(img/b.jpg);
        background-position:center;
        background-repeat:no-repeat;
        background-size:cover;
        text-align:center;
        justify-content:center;
        animation:change 10s infinite ease-in-out;
      }
      @keyframes change{
        0%
        {
          background-image:url(img/b.jpg);
        }
        20%
        {
          background-image:url(img/b2.jpg);
        }
        40%
        {
          background-image:url(img/b3.jpg);
        }
        60%
        {
          background-image:url(img/b4.jpg);
        }
        80%
        {
          background-image:url(img/b5.jpg);
        }
        100%
        {
          background-image:url(img/b6.jpg);
        }
      } 
      #text{ color:white;}
      #input{width:170px;}
      /*TEXT QUI DEFILE*/
      .defiler{
        overflow:hidden; /*cacher ce qui depasse*/
        width:100%;
        display:flex;/*l'une à coté de l'autre*/
       /* transform:rotate(90deg);*//* pour le metre verticale */
      }
      .txt{
        white-space: nowrap; /* ps de a la ligne*/
        font-size:15px;
        display:flex;
        animation:defiler 15s linear infinite;

      }
      /* .t1{ color:red;}
      .t2{color :blue;} */
      @keyframes defiler{
        0%{
          transform:translate(0%,0);
        }
        100%{
          transform:translate(-100%,0);
        }
      }
    </style>

  </head>
  <body style="background:#E6E6FA;">
    
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">SCO-Enicar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron" id="test" style="text-align:center; border:10px solid black;border-radius:40px ">
        <div class="container" id="fond">
          <h1 class="display-3" id="text"><?php echo $bienvenue?>  </h1>
          <p id="text">Personne n’est trop vieux pour se fixer un nouvel objectif ou réaliser de nouveaux rêves.  La seule façon de faire du bon travail est d’aimer ce que vous faites. Si vous n’avez pas encore trouvé, continuez à chercher. Pour réussir, votre désir de réussite doit être plus grand que votre peur de l’échec. </p>
          <button class="spinner-border spinner-grow-sm" id="anim1" style="width:16%;left:50px"><a href="info2.php" role="button" style="color:black;width:100%"></a></button>
          <p><a class="btn btn-primary btn-lg" href="MesGroupes.php" role="button">Mes Groupes &raquo;</a></p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>INFO1</h2>
            <div class="defiler">
              <span class="txt t1"><?=$actu11?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"> <?=$actu11?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="defiler">
              <span class="txt t1"><?=$actu12?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu12?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="defiler">
              <span class="txt t1"><?=$actu13?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu13?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <p><a class="btn btn-secondary" href="info1.php" role="button"><span class="spinner-grow spinner-grow-sm"></span>Voir les Groupes &raquo;</a></p>
          </div>
          <div class="col-md-4" id="test">
            <h2>INFO2</h2>
            <div class="defiler">
              <span class="txt t1"><?=$actu21?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu21?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="defiler">
              <span class="txt t1"><?=$actu22?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu22?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="defiler">
              <span class="txt t1"><?=$actu23?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu23?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <!-- <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p> -->
            <p><a class="btn btn-secondary" href="info2.php" role="button"><span class="spinner-border spinner-border-sm"></span>Voir les Groupes &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>INFO3</h2>
            <div class="defiler">
              <span class="txt t1"><?=$actu31?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu31?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="defiler">
              <span class="txt t1"><?=$actu32?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu32?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="defiler">
              <span class="txt t1"><?=$actu33?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="txt t2"><?=$actu33?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <!-- <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p> -->
            <p><a class="btn btn-secondary" href="info3.php" role="button"><span class="spinner-grow spinner-grow-sm"></span>Voir les Groupes &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->

    </main>


    <footer class="container">
      <p>&copy; ENICAR 2021-2022</p>
    </footer>
      
  </body>
  <footer>
    <!-- <p>&copy; ENICAR 2021-2022</p> -->
  </footer>
  
</html>
