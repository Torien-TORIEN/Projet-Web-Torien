<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
    else {
        include "connexion.php";
        extract($_POST);//Au lieu de $semaine=$_POST['semaine'], ect
        if(isset($_POST['semaine'])){
            $date=date("d-m-Y",strtotime($semaine));//Recuperer la 1re date de la semaine
            $_SESSION["date"]=$date;
            $_SESSION["module"]=$module;
            $_SESSION["classe"]=$classe;
            $Date=date_create($date);//Creer un objet date
            //echo $semaine.$module.$classe;
            //echo $date;

            //La requette
            $req="SELECT * from etudiant where Classe='$classe' ";
            $reponse = $pdo->query($req);
            if($reponse->rowCount()>0) {
                //echo "YES DANS LE ROW";
                $nbEtds=$reponse->rowCount();
                $table='<div class="alert alert-success">
                        <h4 style="text-align:center;">Fiche D\'absence</h4>
                        <h5 style="text-align:center;">Groupe : '.$classe.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Module : '.$module.'</h5></div>';
                $table.='<form action="saisieAbsData.php" method="POST"><table name=\"tab\" rules="cols" frame="box"><tr><th> '.$nbEtds.' étudiants</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;color:red;">Lundi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;color:blue;">Mardi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;color:green;">Mercredi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;color:cyan;">Jeudi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;color:black;">Vendredi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;color:orange;">Samedi</th></tr>';
                $table.='<tr><td>&nbsp;</td>';
                $table.='<th colspan="2" width="100px"  style="padding-left: 5px; padding-right: 5px;">'.date("d/m/Y",strtotime($date)).'</th>';
                $table.='<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">'.date_format(date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y").'</th>';
                $table.='<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">'.date_format(date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y").'</th>';
                $table.='<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">'.date_format(date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y").'</th>';
                $table.='<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">'.date_format(date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y").'</th>';
                $table.='<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">'.date_format(date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y").'</th>';
                $table.='</tr><tr><td>&nbsp;</td>';
                $table.='<th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th>';
                $table.='</tr>';
                while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
                    $table.='<tr class="row_3"><td colspan="1"><b>
                                '.$row["cin"].'&nbsp;&nbsp;
                                '.$row["nom"].'&nbsp;
                                '.$row["prenom"].'
                            </b></td>
                          <td style="text-align:center;color:red;">J<input type="checkbox" name="JLundi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NLundi[]" value="'.$row["cin"].'"></td>
                          <td style="text-align:center;color:red;">J<input type="checkbox" name="JLundi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NLundi[]" value="'.$row["cin"].'"></td>

                          <td style="text-align:center;color:blue;">J<input type="checkbox" name="JMardi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NMardi[]" value="'.$row["cin"].'"></td>
                          <td style="text-align:center;color:blue;">J<input type="checkbox" name="JMardi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NMardi[]" value="'.$row["cin"].'"></td>

                          <td style="text-align:center;color:green;">J<input type="checkbox" name="JMercredi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NMercredi[]" value="'.$row["cin"].'"></td>
                          <td style="text-align:center;color:green;">J<input type="checkbox" name="JMercredi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NMercredi[]" value="'.$row["cin"].'"></td>
                          
                          <td style="text-align:center;color:cyan;">J<input type="checkbox" name="JJeudi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NJeudi[]" value="'.$row["cin"].'"></td>
                          <td style="text-align:center;color:cyan;">J<input type="checkbox" name="JJeudi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NJeudi[]" value="'.$row["cin"].'"></td>

                          <td style="text-align:center;color:black;">J<input type="checkbox" name="JVendredi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NVendredi[]" value="'.$row["cin"].'"></td>
                          <td style="text-align:center;color:black;">J<input type="checkbox" name="JVendredi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NVendredi[]" value="'.$row["cin"].'"></td>

                          <td style="text-align:center;color:orange;">J<input type="checkbox" name="JSamedi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NSamedi[]" value="'.$row["cin"].'"></td>
                          <td style="text-align:center;color:orange;">J<input type="checkbox" name="JSamedi[]" value="'.$row["cin"].'">  N<input type="checkbox" name="NSamedi[]" value="'.$row["cin"].'"></td>';
                }
                $table.='</table>';
                $table.='<br><div><button type="submit" name="button_submit" class="btn btn-primary" >Enregistrer</button></div></form>';

                echo $table;
                //echo $date;
            }
            else{
                echo '<div class="alert alert-danger"><h4 style="text-align:center;">Aucun Etudiant de ce Groupe</h4></div>';
            }
        }
    }
?>