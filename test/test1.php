<?php
        if( !empty($_POST['secteur']) )
        {
 
                        echo "Vous avez choisi <b>".$_POST['secteur']."</b>";
 
        }
        $var="123456789"
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
</head>
<body>
        <div>
        <form action="" method="post">
            <select class="form-control" style="width:auto" name="secteur">
                <option value="">Sélectionner votre secteur</option>
                <option value="SECTEUR_1">SECTEUR 1</option>
                <option value="SECTEUR_2">SECTEUR 2</option>
                <option value="SECTEUR_3">SECTEUR 3</option>
                <option value="SECTEUR_4">SECTEUR 4</option>
	        </select>
            <input type="text" readonly="readonly" value="corcelles" />
            <label  class="form-control"><?php echo( $var);?></label>
            <input type="submit" name="submit" />
        </form></div>
        <div id="test">changerCouleur</div>
        <input type="button" onclick="changerCouleur()" value="changer">
    <script>
        function changerCouleur(){
            document.getElementById("test").innerHTML="YES YES";
            document.getElementById("test").style.color="red";
        }
    </script>
    
</body>
</html>