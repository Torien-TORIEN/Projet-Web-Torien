<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
    include("connexion.php");
    if(isset($_GET['input'])){
        $input=$_GET['input'];
        $req="SELECT * from etudiant where cin like '{$input}%'";
        $result=$pdo->query($req);
        if($result->rowCount()>0){
            ?>
            <table class="table table-striped table-hover">

                <tr>
                    <th>CIN</th>
                    <th>NOM</th>
                    <th>Prénom</th>
                    <th>email</th>
                    <th>Classe</th>
                </tr>
            <td>
                <?php 
                    while($row=$result->fetch(PDO::FETCH_ASSOC)){
                        $cin=$row['cin'];
                        $nom=$row['nom'];
                        $prenom=$row['prenom'];
                        $email=$row['email'];
                        $classe=$row['Classe'];
                ?>
                        <tr>
                            <td><?=$cin;?></td>
                            <td><?=$nom;?></td>
                            <td><?=$prenom;?></td>
                            <td><?=$email;?></td>
                            <td><?=$classe;?></td>
                        </tr>
                <?php 
                    }
                ?>
            </td>
            </table>
 <?php 
        }else{
            echo"<script>document.getElementById('search').style.color='red';document.getElementById('search').innerHTML='CIN NOT FOUND';</script>";
        }
    }
}
?>