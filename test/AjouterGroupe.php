<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Grourpe</title>
</head>
<body>
    <form id="myForm" method="post" >
                <div class="form-group">
                  <input type="text" id="classe" name="groupe" class="form-control" placeholder="saisir le groupe" required pattern="INFO[1-3]{1}-[A-E]{1}"
                  title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
                   <button  type="button" onclick="ajouter()">Ajouter</button>
                </div>
    </form>
    <div id='demo'></div>
    <script>
    function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/Projet/test/ajouterG.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

        form=document.getElementById("myForm");
        formdata=new FormData(form);

        xmlhttp.send(formdata);

        //Traiter Res

        xmlhttp.onreadystatechange=function()
            {   
                if(this.readyState==4 && this.status==200){
                 alert(this.responseText);
                    if(this.responseText=="OK")
                    {
                        document.getElementById("demo").innerHTML="L'ajout de l'étudiant a été bien effectué";
                        document.getElementById("demo").style.backgroundColor="green";
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML="L'étudiant est déjà inscrit, merci de vérifier le CIN";
                        document.getElementById("demo").style.backgroundColor="#fba";
                    }
                }
            }
        
        
    }
    </script>
</body>
</html>