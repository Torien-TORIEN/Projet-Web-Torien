<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
    }
    else {
        include "connexion.php";
        extract($_POST);
        if(isset($_POST["debut"]) && isset($_POST["fin"]) && isset($_POST["classe"])){
            $sql="SELECT * from absence where groupe='$classe' and TIMESTAMPDIFF(DAY,'$debut',date)>=0 and TIMESTAMPDIFF(DAY,date,'$fin')>=0";
            $reponse = $pdo->query($sql);
            //$reponse=$pdo->query(" SELECT cin,nom,prenom,groupe,date,min(date) as mdate,max(date) as Mdate,count(DISTINCT(date)) as nb,sum(justifie) as justifie,sum(nonJustifie) as nonJustifie from absence group by cin having groupe='$classe' and( TIMESTAMPDIFF(DAY,'$debut',mdate)>=0 and TIMESTAMPDIFF(DAY,date,'$fin')>=0 )");
            //$reponse=$pdo->query(" SELECT DISTINCT(cin),nom,prenom,login,groupe ,sum(justifie) as justifie ,sum(nonJustifie) as nonJustifie from absence where groupe='$classe'and date between '$debut' and '$fin' ");
            //$reponse=$pdo->query(" SELECT cin ,nom,prenom,login,groupe,date,sum(justifie) as justifie ,sum(nonJustifie) as nonJustifie from absence group by cin having groupe='$classe' and date between '$debut' and '$fin' ");
            //echo TIMESTAMPDIFF(DAY,$debut,$fin);//return a number of the difference between two dates given in day (hours)
            //echo $debut." / ".$fin." / ".$classe;
            //CHANGER LE FORMAT DE DATE 
            $timestamp1=strtotime($debut);
            $timestamp2=strtotime($fin);
            $newDebut = date("d/m/Y", $timestamp1 );
            $newFin = date("d/m/Y", $timestamp2 );
            //$row1 = $reponse ->fetch(PDO::FETCH_ASSOC);//condition ajouter tsy ela 
            //$TT=$row1["justifie"]+$row1["nonJustifie"];
            if($reponse->rowCount()>0){//et les autres
                $table='<br> <div class="alert alert-success" role="alert"><h4 style="text-align:center;color:green;">Fiche d\'absence du &nbsp;'.$newDebut.'&nbsp;&nbsp;&nbsp;à&nbsp;&nbsp;&nbsp;  '.$newFin.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    Classe  :'.$classe.'</h4></div>';
                $table.='<table class="table table-dark table-hover">
                <thead class="thead-dark"><tr class="gt_firstrow " >
                <th >CIN</th>
                <th >Noms</th>
                <th >Prénom</th>
                <!--<th >date</th>
                <th >date</th>
                <th >Maxdate</th>
                <th >Nbr</th>-->
                <th style="text-align:center;">Justifiées</th>
                <th style="text-align:center;">Non justifiées</th>
                <th style="text-align:center;">Total</th></tr>
                </thead><tbody>'; 
                
                /* $outs[]=array();
                $i=0;
                while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
                    $outs[$i]=$row;
                    $cin=$row["cin"];
                    $nom=$row["nom"];
                    $prenom=$row["prenom"];
                    //$date=$row["date"];
                    $justifie=$row["justifie"];
                    $NJ=$row["nonJustifie"];
                    $total=$justifie+$NJ;
                    $classe=$row["groupe"];
                    $table.='<tr>
                    <td>'.$cin.'</td>
                    <td><b>'.$nom.'</b></td>
                    <td>'.$prenom.'</td>
                    <td style="text-align:center;">'.$justifie.'</td>
                    <td style="text-align:center;">'.$NJ.'</td>
                    <td style="text-align:center;">'.$total.'</td></tr>';

                    $i++;
                }
                $table.='</tbody> </table>';
                //echo count($outs);
                //echo json_encode($outs);
                //echo print_r($outs[0]['cin']);
                //echo $table; */



                //CONDITION D'AFFICHAGE
                $outs[]=array();
                $i=0;
                //Metre dans un tableau aouts tous les resultats
                while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
                    $outs[$i]=$row;
                    $i++;
                }
                //echo count($outs);
                //echo print_r($outs);
                $entiers=array();
                $i=0;
                while($i<count($outs)){
                    if(in_array(@$outs[$i]['cin'],$entiers)){
                        //echo $i." EXISTE<br>";
                        $i++;
                        continue;
                    }
                    else{
                        //echo $i." EXISTE PAS<br>";
                        array_push($entiers,@$outs[$i]['cin']);
                        @$cin=$outs[$i]['cin'];
                        @$nom=$outs[$i]['nom'];
                        @$prenom=$outs[$i]['prenom'];
                        @$classe=$outs[$i]['groupe'];
                        @$justifie=$outs[$i]['justifie'];
                        @$NJ=$outs[$i]['nonJustifie'];
                        $j=$i+1;
                        while($j<count($outs)){
                            if($outs[$j]['cin']==$cin){ 
                                $justifie+=$outs[$j]['justifie'];
                                $NJ+=$outs[$j]['nonJustifie'];
                            }
                            $j++;
                        }
                        $total=$justifie+$NJ;
                        //echo "Justifié au total=".$justifie."<br>";
                        //echo "NONJustifié au total=".$NJ."<br>";
                        //echo "TOTAL=".$total."<br>";
                        // table
                        $table.='<tr>
                        <td>'.$cin.'</td>
                        <td><b>'.$nom.'</b></td>
                        <td>'.$prenom.'</td>
                        <td style="text-align:center;">'.$justifie.'</td>
                        <td style="text-align:center;">'.$NJ.'</td>
                        <td style="text-align:center;">'.$total.'</td></tr>';

                        $i++;
                    }
            }
            $table.='</tbody> </table>';
            echo $table;
            //CONDITION D'Affichage fin
            }else{
               echo '<br><div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>OUPS !</strong> , Aucune liste correspondante au groupe et aux dates que vous avez choisies. 
                        Veuillez choisir les bonnes dates !
                    </div>';
            }
        }
    }
    
?>