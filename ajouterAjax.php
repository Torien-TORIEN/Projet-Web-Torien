<?php 
    session_start();
    if($_SESSION["autoriser"]!="oui"){
       header("location:login.php");
       exit();
    }
     else{
         include ("connexion.php");
         extract($_POST);
         $req="SELECT * from etudiant where cin=$cin";
         $resultat=$pdo->query($req);
         if($resultat->rowCount()>0){
             echo"NO";
         }else{
             $sql="insert into etudiant values ($cin,'$email',md5('$pwd'),md5('$cpwd'),'$nom','$prenom','$adresse','$classe')";
             $reponse=$pdo->query($sql) or die("ERROR 2E REQUETTE");
            echo" BRAVO  : AJOUT AVEC SUCCES !";
         }
     }
?>