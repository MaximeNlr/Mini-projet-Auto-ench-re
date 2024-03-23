<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css"/>
    <link rel="icon" type="image/png" href="../../View/images/logo1.png" />
</head>
<header>
    <img src="../../View/images/logo1.png" alt="Logo">
</header>
<body>
    <?php
        if(isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); 
        }
    ?>           
    <div class="container">
        <div class="signin">
            <form action="../../Model/login_data.php" method="POST">
                <h2>Connexion</h2>
                <div class="inputs">
                    <input type="text" name="email" placeholder="Email" required/>
                </div>
                <div class="inputs">
                    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required/>
                </div>
                <input type="submit" value="Valider" id="btn">
            </form>
            <div class="right-side">
                <img src="../../View/images/form_background.jpg" alt="" />
            </div>
        </div>
    </div>
</body>
</html>