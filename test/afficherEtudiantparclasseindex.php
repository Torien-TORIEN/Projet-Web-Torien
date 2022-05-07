<?php 


include "connexion2.php";
$Classe=$_POST['Classe2'];
$Classe=trim($Classe);
$requete=" SELECT * from etudiant where Classe='{$Classe}'";
$res3=mysqli_query($conn,$requete);
while($row2=mysqli_fetch_array(($res3))){ 
?>


  
<tr>
<td><?php echo $row2['cin'];?></td>
<td><?php echo $row2['email'];?></td>
<td><?php echo $row2['nom'];?></td>
<td><?php echo $row2['prenom'];?></td>
<td><?php echo $row2['adresse'];?></td>
<td><?php echo $row2['Classe'];?></td>

</tr>









<?php } 

echo $requete;
?>