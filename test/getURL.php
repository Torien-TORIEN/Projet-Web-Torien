<?php
    function currentURL(){
        $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $validURL=str_replace("&","&amp;",$url);
        $tes=$_SERVER['REQUEST_URI'];
        return $validURL;
        //return $tes;
    }
    //echo "L'url de la page courante c'est :".currentURL();
    $url="http://localhost/Projet/test/test1.php";
    //header("location:$url");
    $rl=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $_SESSION["url"]=str_replace("&","&amp;","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    echo $_SESSION['url'];
?>