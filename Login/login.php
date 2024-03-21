

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="login.css"/>
    </head>
    <body>

    <h1>Page connection</h1>
            <form action="../Login/loginData.php" method="POST">
                <div class="loginContainer">
                    <h1>Connexion</h1>
                    <div class="inputs">
                        <div class="input">
                            <img src="../Assets/email.png" alt=""/>
                            <input type="email" id="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="input">
                            <img src="../Assets/password.png" alt=""/>
                            <input type="password" id="password" name="mot_de_passe" placeholder="Mot de passe" required />
                        </div>
                        <input type="submit" class="submit" />
                    </div>
                </div>
            </form>
    </body>
</html>