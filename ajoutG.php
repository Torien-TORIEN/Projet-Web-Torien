<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {

$classe=$_REQUEST['groupe'];


include("connexion.php");
         $login=$_SESSION["login"];
         $sel=$pdo->prepare("select * from groupe where login=? and nom=? limit 1");
         $sel->execute(array($login,$classe));
         $tab=$sel->fetchAll();
         if(count($tab)>0){
            $erreur="NOT OK";// Etudiant existe déja
            $_SESSION["ajout"]="not ok";
            header("location:AjouterGroupe.php");
         }
         else{
            $req="insert into groupe (login,nom) values ('$login','$classe')";
            $reponse = $pdo->exec($req) or die("error");
            $erreur ="OK";
            $_SESSION["ajout"]="ok";
            header("location:AjouterGroupe.php");
         }
}
?>