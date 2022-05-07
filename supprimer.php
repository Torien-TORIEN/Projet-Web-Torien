<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
    include("connexion.php");
    $id=$_POST['delete_id'];
    $query=$pdo->query("DELETE FROM etudiant where cin LIKE'{$id}%'");
    $result=$pdo->query("DELETE FROM absence where cin LIKE'{$id}%'");
}
?>