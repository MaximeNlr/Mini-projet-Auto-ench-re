<?php 
    session_start();

    if(isset($_SESSION['id_utilisateur'])) {
        session_destroy();
        header("location: ../View/Home/index.php");
        exit();
    }
?>