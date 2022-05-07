<!DOCTYPE html>
<html lang="en">
<head>
    <title>CONTROLE FORMULAIRE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
</head>
<body>
    <div class="jumbotron">
        <h2 style="text-align:center">CONTROLER AVEC JAVASCRIPT JQuery et AJAX</h2>
    </div>

    <div class="container">
        <h4 class="" style="text-align:center">Formulaire à Controler</h4>
        <form action="">
            <!--Nom-->
            <div class="form-group">
                <label for="nom">Nom:</label><br>
                <input type="text" id="nom" name="nom" class="form-control" required autofocus>
            </div>
            <!--Email-->
            <div class="form-group">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <button type=" button" class="btn btn-primary" onclick="controlerEmail()">Enregistrer </button>
        </form>
        <button type=" button" class="btn btn-primary" onclick="controlerEntier()">Tester </button>

    </div>
    

    <script src="https//cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
    <script src="https//cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.0-1/md5.js"></script>
    <script>
        $(document).ready(function(){
            decrypterMD5("test");
        });
        function controlerEmail(){
            var email=$("#email").val();
            if(email!=''){
                var regex=/^\w+([\.-]w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if(email.match(regex)){
                    alert("Adresse email correct");
                }
                else{
                    alert("adresse email non valide");
                }
            }else{
                alert("Email est vide !");
            }
        }
        function controlerEntier(){
            var nom=document.getElementById("nom").value;
            //var id=$("#nom").val();
            alert(nom);
        }
        function crypterMD5(mot){

        }
        function decrypterMD5(mot){
            var md5Hash=CryptoJS.MD5("test");
            alert(md5Hash);
        }
    </script>
</body>
</html>