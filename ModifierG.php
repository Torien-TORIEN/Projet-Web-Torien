<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$groupe=$_REQUEST['classe'];
$Ngroupe=$_REQUEST['Nclasse'];



include("connexion.php");
         $sel=$pdo->prepare("select * from groupe where nom=? limit 1");
         $sel->execute(array($groupe));
         $tab=$sel->fetchAll();
         if(count($tab)==0){
           // Aucun groupe
            $_SESSION["modG"]="not ok";
            header("location:ModifierGroupe.php");
         }
         else{
            echo $groupe."et".$Ngroupe;
            $login=$_SESSION['login'];
            //SUPPRIMER LE DOUBLON DANS LA TABLE GROUPE{
            $sel=$pdo->prepare("select * from groupe where login=? and nom=?");
            $sel->execute(array($login,$Ngroupe));
            $tab=$sel->fetchAll();
            if(count($tab)>0){
              //Y'a déjà un groupe que nous allons inséré 
              //Dans ce cas on supprimer le groupe à modifier pour éviter le doublon
              $sel=$pdo->prepare("delete from groupe where nom=? and login=? ");
              $sel->execute(array($groupe,$login));
            }
            else{
              $sel=$pdo->prepare("update groupe set nom=? where nom=? and login=?");
              $sel->execute(array($Ngroupe,$groupe,$login));
            }
            //SUPPRIMER LE DOUBLON DANS LA TABLE GROUPE}
            
            /*if(reponse){
            $sel=$pdo->prepare("update etudiant set classe=? WHERE classe=?");
            $sel->execute(array($Ngroupe,$groupe));}*/
            $_SESSION["modG"]="ok";
           header("location:ModifierGroupe.php");
         }
}
?>