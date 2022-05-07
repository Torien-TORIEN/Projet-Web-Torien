<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:login.php");
        exit();
     }
    else {
        //$variable="TORIEN TORIEN";
        //echo strlen($variable)."<br>";//la taille de la variable $variable de type string avec l'espace tout ça
        include "connexion.php";
        if(isset($_POST["button_submit"])){//isset(name_button)
            if(isset($_POST["JLundi"]) ||isset($_POST["NLundi"]) || isset($_POST["JMardi"]) ||isset($_POST["NMardi"]) || isset($_POST["JMercredi"]) ||isset($_POST["NMercredi"]) ||isset($_POST["JJeudi"]) ||isset($_POST["NJeudi"]) || isset($_POST["JVendredi"]) ||isset($_POST["NVendredi"]) ||isset($_POST["JSamedi"]) ||isset($_POST["JSamedi"]) ){
                $module=$_SESSION["module"];
                $classe=$_SESSION["classe"];
                echo $module."<br>";
                echo $classe."<br>";
                //LUNDI
                if(isset($_POST["JLundi"]) ||isset($_POST["NLundi"])){
                    echo "LUNDI";
                    $daty=$_SESSION["date"];//EN SQL date=Y-m-d H:M:S (format DATETIME)
                    $date=date("Y-m-d",strtotime($daty));//Changer le format de date 
                    echo "<br>".$date."<br>";
                    //Justifié
                    if(isset($_POST["JLundi"])){
                        echo "<br>LUNDI JUSTIFIE<br>";
                        $all_id=$_POST["JLundi"];//$_POST["name_checkbox"] tableau de cin checked
                        //print_r($all_id);
                        //echo count($all_id)."<br>";//La taille
                        $extract_id=implode(',',$all_id);// Convertir les élements du tableau en chaine de charactère separé par ',' Extract all checkboxs checked with separator ','
                        //echo gettype($extract_id);//pour voir le type de variable $extract_id
                        //echo $extract_id."<br>";//to read what checkboxs are checked
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set justifie=justifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR LUNDI JUSTIFIE");
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',1,0,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR LUNDI NON JUSTIFIE");
                            }
                            $i++;
                        }
                    }
                    //Non Justifié
                    if(isset($_POST["NLundi"])){
                        echo "<br>LUNDI NON JUSTIFIE<br>";
                        $all_id=$_POST["NLundi"];
                        $extract_id=implode(',',$all_id);
                        //echo $extract_id;
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set nonJustifie=nonJustifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR LUNDI NON JUSTIFIE");
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',0,1,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR LUNDI NON JUSTIFIE");
                            }
                            $i++;
                        }

                    }

                }

                //MARDI
                if(isset($_POST["JMardi"]) ||isset($_POST["NMardi"])){
                    echo "MARDI";
                    $daty=$_SESSION["date"];
                    $Date=date_create($daty);//Creer un objet date
                    $date=date_format(date_add($Date,date_interval_create_from_date_string("1 days")),"Y-m-d");
                    echo "<br>".$date."<br>";
                    //Justifié
                    if(isset($_POST["JMardi"])){
                        echo "<br>MARDI JUSTIFIE<br>";
                        $all_id=$_POST["JMardi"];
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set justifie=justifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR MARDI JUSTIFIE");
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',1,0,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR MARDI  JUSTIFIE");
                            }
                            $i++;
                        }
                    }
                    //Non Justifié
                    if(isset($_POST["NMardi"])){
                        echo "<br>MARDI NON JUSTIFIE<br>";
                        $all_id=$_POST["NMardi"];
                        $extract_id=implode(',',$all_id);
                        //echo $extract_id;
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set nonJustifie=nonJustifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR MARDI NON JUSTIFIE");
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',0,1,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR MARDI NON JUSTIFIE");
                            }
                            $i++;
                        }

                    }

                }

                //MERCREDI
                if(isset($_POST["JMercredi"]) ||isset($_POST["NMercredi"])){//MOD
                    echo "MERCREDI";
                    $daty=$_SESSION["date"];
                    $Date=date_create($daty);//Creer un objet date
                    $date=date_format(date_add($Date,date_interval_create_from_date_string("2 days")),"Y-m-d");//MOD
                    echo "<br>".$date."<br>";
                    //Justifié
                    if(isset($_POST["JMercredi"])){//MOD
                        echo "<br>MERCREDI JUSTIFIE<br>";//MOD
                        $all_id=$_POST["JMercredi"];//MOD
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set justifie=justifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR MERCREDI JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',1,0,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR MERCREDI  JUSTIFIE");//MOD
                            }
                            $i++;
                        }
                    }
                    //Non Justifié
                    if(isset($_POST["NMercredi"])){//MOD
                        echo "<br>MERCREDI NON JUSTIFIE<br>";//MOD
                        $all_id=$_POST["NMercredi"];//MOD
                        $extract_id=implode(',',$all_id);
                        //echo $extract_id;
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set nonJustifie=nonJustifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR MERCREDI NON JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',0,1,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR MERCREDI NON JUSTIFIE");//MOD
                            }
                            $i++;
                        }

                    }

                }

                //JEUDI
                if(isset($_POST["JJeudi"]) ||isset($_POST["NJeudi"])){//MOD
                    echo "JEUDI";
                    $daty=$_SESSION["date"];
                    $Date=date_create($daty);//Creer un objet date
                    $date=date_format(date_add($Date,date_interval_create_from_date_string("3 days")),"Y-m-d");//MOD
                    echo "<br>".$date."<br>";
                    //Justifié
                    if(isset($_POST["JJeudi"])){//MOD
                        echo "<br>JEUDI JUSTIFIE<br>";//MOD
                        $all_id=$_POST["JJeudi"];//MOD
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set justifie=justifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR JEUDI JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',1,0,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR JEUDI  JUSTIFIE");//MOD
                            }
                            $i++;
                        }
                    }
                    //Non Justifié
                    if(isset($_POST["NJeudi"])){//MOD
                        echo "<br>JEUDI NON JUSTIFIE<br>";//MOD
                        $all_id=$_POST["NJeudi"];//MOD
                        $extract_id=implode(',',$all_id);
                        //echo $extract_id;
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set nonJustifie=nonJustifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR JEUDI NON JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',0,1,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR JEUDI NON JUSTIFIE");//MOD
                            }
                            $i++;
                        }

                    }

                }
                

                //VENDREDI
                if(isset($_POST["JVendredi"]) ||isset($_POST["NVendredi"])){//MOD
                    echo "VENDREDI";
                    $daty=$_SESSION["date"];
                    $Date=date_create($daty);//Creer un objet date
                    $date=date_format(date_add($Date,date_interval_create_from_date_string("4 days")),"Y-m-d");//MOD
                    echo "<br>".$date."<br>";
                    //Justifié
                    if(isset($_POST["JVendredi"])){//MOD
                        echo "<br>VENDREDI JUSTIFIE<br>";//MOD
                        $all_id=$_POST["JVendredi"];//MOD
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set justifie=justifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR VENDREDI JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',1,0,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR VENDREDI  JUSTIFIE");//MOD
                            }
                            $i++;
                        }
                    }
                    //Non Justifié
                    if(isset($_POST["NVendredi"])){//MOD
                        echo "<br>VENDREDI NON JUSTIFIE<br>";//MOD
                        $all_id=$_POST["NVendredi"];//MOD
                        $extract_id=implode(',',$all_id);
                        //echo $extract_id;
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set nonJustifie=nonJustifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR VENDREDI NON JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',0,1,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR VENDREDI NON JUSTIFIE");//MOD
                            }
                            $i++;
                        }

                    }

                }

                //SAMEDI
                if(isset($_POST["JSamedi"]) ||isset($_POST["NSamedi"])){//MOD
                    echo "SAMEDI";
                    $daty=$_SESSION["date"];
                    $Date=date_create($daty);//Creer un objet date
                    $date=date_format(date_add($Date,date_interval_create_from_date_string("5 days")),"Y-m-d");//MOD
                    echo "<br>".$date."<br>";
                    //Justifié
                    if(isset($_POST["JSamedi"])){//MOD
                        echo "<br>SAMEDI JUSTIFIE<br>";//MOD
                        $all_id=$_POST["JSamedi"];//MOD
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set justifie=justifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR SAMEDI JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',1,0,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR SAMEDI  JUSTIFIE");//MOD
                            }
                            $i++;
                        }
                    }
                    //Non Justifié
                    if(isset($_POST["NSamedi"])){//MOD
                        echo "<br>SAMEDI NON JUSTIFIE<br>";//MOD
                        $all_id=$_POST["NSamedi"];//MOD
                        $extract_id=implode(',',$all_id);
                        //echo $extract_id;
                        $i=0;
                        while($i<count($all_id)){
                            echo $all_id[$i]."<br>";
                            $req="SELECT nom ,prenom,email from etudiant where cin=$all_id[$i] ";
                            $reponse=$pdo->query($req);
                            $row = $reponse ->fetch(PDO::FETCH_ASSOC);
                            $nom=$row['nom'];
                            $prenom=$row['prenom'];
                            $email=$row['email'];
                            print_r($row);
                            echo "<br>";
                            $sql="SELECT * from absence where cin=$all_id[$i] and date='$date' and matiere='$module' ";
                            $result=$pdo->query($sql);
                            $tab=$result->fetchAll();
                            if(count($tab)>0){
                                echo "\nMISY<br><br>";
                                $query="UPDATE absence set nonJustifie=nonJustifie+1 where cin=$all_id[$i] and date='$date' and matiere='$module'";
                                $reply=$pdo->query($query) or die("ERROR SAMEDI NON JUSTIFIE");//MOD
                            }else{
                                echo "\nTSISY<br><br>";
                                $query="INSERT into absence (cin,nom,prenom,justifie,nonJustifie,date,matiere,groupe,login) 
                                        values ($all_id[$i],'$nom','$prenom',0,1,'$date','$module','$classe','$email')";
                                $reply=$pdo->query($query) or die("ERROR SAMEDI NON JUSTIFIE");//MOD
                            }
                            $i++;
                        }

                    }

                }
                $_SESSION["msg"]='<div class="alert alert-success"><h4 style="text-align:center;"> Absence Bien Enregistrée !</h4></div>';
                header("location:saisirAbsence.php");
            }else{
                $_SESSION["msg"]='<div class="alert alert-danger"><h4 style="text-align:center;">Aucune Case Cochée !</h4></div>';
                header("location:saisirAbsence.php");
            }
        }
    }
    
?>
