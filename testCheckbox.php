<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ChexBox</title>
        <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="./assets/jumbotron.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="row justify-contentcenter">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>DELETE Data Using Checkbox</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- AFFICHER LE MESSAGE DU RESULTAT -->
                <?php
                    if(isset($_SESSION["status"])){
                        echo '<div class="alert alert-warning"><h5 style="text-align:center">'.$_SESSION["status"].'</h5></div>';
                        unset($_SESSION["status"]);//Détruire la variable
                    }
                ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="testCode.php" method="POST">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th><button type="submit" name="stud_delete_multiple_btn" class="btn btn-danger">Delete</button></th>
                                        <th>N°</th>
                                        <th>Names</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Place</th>
                                    </tr>
                                </tbody>
                                    <?php
                                        include "testConnect.php";
                                        $query="SELECT * from crud";
                                        $query_run=mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run)>0){
                                            foreach($query_run as $row){
                                                ?>
                                                <tr>
                                                    <td style="width:10px;text-align:center;"><input type="checkbox" name="stud_delete_id[]" value="<?=$row['id'];?>"></td>
                                                    <td><?=$row['id'];?></td>
                                                    <td><?=$row['name'];?></td>
                                                    <td><?=$row['email'];?></td>
                                                    <td><?=$row['mobile'];?></td>
                                                    <td><?=$row['place'];?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else{
                                            ?>
                                                <tr>
                                                    <td colspan="6" style="text-align:center;">No Record Found </td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                <tbody>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>