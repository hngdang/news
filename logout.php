<?php
    require_once('functions.php');
    if(isset($_COOKIE['news'])){
        setcookie("news", '', time()-1);
    }
    redirect('index.php');
?>