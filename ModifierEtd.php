<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
    else {
        include "connexion.php";
        //Update query
        if(isset($_POST['id'])){
            $cin=$_POST['id'];
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $pwd=$_POST['pwd'];
            $cpwd=$_POST['cpwd'];
            $email=$_POST['email'];
            $classe=$_POST['classe'];
            $adresse=$_POST['adresse'];
            $sql="UPDATE etudiant set nom='$nom' ,prenom='$prenom',Classe='$classe' ,email='$email', password=md5('$pwd'),cpassword=md5('$cpwd'),adresse='$adresse' where cin=$cin ";
            $req="UPDATE absence set  nom='$nom' ,prenom='$prenom',groupe='$classe' ,login='$email'  where cin=$cin";
            $reponse=$pdo->query($req);
            $result=$pdo->query($sql);
        }

    }
?>
    