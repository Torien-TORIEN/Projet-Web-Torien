<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$groupe=$_REQUEST['classe'];


include("connexion.php");
         $login=$_SESSION['login'];
         $sel=$pdo->prepare("select * from groupe where nom=? and login=? limit 1");
         $sel->execute(array($groupe,$login));
         $tab=$sel->fetchAll();
         if(count($tab)==0){
           // Aucun groupe
            $_SESSION["suppG"]="not ok";
            header("location:SupprimerGroupe.php");
         }
         else{
            $sel=$pdo->prepare("delete from groupe where nom=? and login=?");
            $sel->execute(array($groupe,$login));
            /*$sel=$pdo->prepare("delete from etudiant  where classe=?");
            $sel->execute(array($groupe));*/
            //$erreur ="OK";
            $_SESSION["suppG"]="ok";
            header("location:SupprimerGroupe.php");
         } 
}
?>