<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {

$classe=$_REQUEST['groupe'];


include("connexion.php");
         $sel=$pdo->prepare("select * from groupe where nom=? limit 1");
         $sel->execute(array($classe));
         $tab=$sel->fetchAll();
         if(count($tab)>0){
            $erreur="NOT OK";// Etudiant existe déja
            //$_SESSION["ajout"]="not ok";
            header("location:AjouterGroupe.php");
         }
         else{
            $req="insert into groupe values ('$classe')";
            $reponse = $pdo->exec($req) or die("error");
            $erreur ="OK";
            //$_SESSION["ajout"]="ok";
            header("location:test/AjouterGroupe.php");
         }
}
?>