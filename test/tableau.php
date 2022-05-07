<?php
    $sub=$_POST['sub'];
    @$lundi=$_POST["lolo"];
    @$l=$_POST["lundi"];
    @$m=$_POST["monday"];
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Tableau</title>
</head>
<body>
    <form action="" method="post">
        <label for="" name name="lolo">COMMENT RECUPERER UNE DONNEE D'UN TABLEAU?</label><br>
        <input type="text" name="nom" placeholder="nom">
        <table rules="cols" frame="box">
            <tr><th>25 étudiants</th>
        
            <th colspan="2" width="100px" name="lundi" style="padding-left: 5px; padding-right: 5px;">Lundi</th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mardi</th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mercredi</th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Jeudi</th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Vendredi</th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Samedi</th>
            </tr><tr><td>&nbsp;</td>
            <th colspan="2" width="100px"  style="padding-left: 5px; padding-right: 5px;"><?php echo date("d/m/Y");?></th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php ;?></th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php ?></th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php ?></th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php ?></th>
            <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php ;?></th></tr>
        </table>
        <button type="submit">Valider</button>
    </form>
    <!-- TEST SUR UN TABLEAU -->
    <div>
    <form action="" method="post">
        <table rules="cols" frame="box" method="post">
            <tr>
            
                <th colspan="2" name="lundi" value="lundi" id="lundi">Lundi</th>
                <th colspan="2" name="mardi" value="Mardi">Mardi</th>
                <th colspan="2" name="mercredi" value="Mercredi">Mercredi</th>
            </tr>
            <tr>
                
                <th colspan="2" ><?php echo'<input type="text" readonly="readonly" name="monday" value="monday">' ;?></th>
                <th colspan="2" name="Tuesday" value="Tuesday">Tuesday</th>
                <th colspan="2" name="Wednesdayi" value="Wednesday">Wednesday</th>
            </tr>
        </table>
        <input type="text" name="imm" value="immodifiable" readonly="readonly">
        <input type="text" name="sub" id="sub">
        <button type="submit" > ok</button>
    </form>
    </div>
    <h3><?php echo "Vous avez tapé ".$sub."<br>"; ?></h3>
    <h3><?php echo "INPUT IMM= ".@$_POST["imm"]."<br>"; ?></h3>
    <h3><?php echo "Monday= ".@$_POST["monday"]."<br>"; ?></h3>
</body>
</html>