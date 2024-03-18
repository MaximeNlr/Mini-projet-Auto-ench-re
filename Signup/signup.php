<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css"/>
</head>
<body>
    <form action="../Data/signupData.php" method="POST">
        <div class="headerForm">
            <div class="text">Inscription</div>
            <div class="underline"></div>
        <div class="signupContainer">
            <div class="inputs1">
                <div class="input">
                    <img src="../Assets/person.png" alt =""/>
                    <input type="text" id="nom" name="nom" placeholder="Nom" required />
                </div>
                <div class="input">
                    <img src="../Assets/person.png" alt =""/>
                    <input type="text" id="prenom" name="prenom" placeholder="Prénom" required />
                </div>
            </div>  
            <div class="inputs2">
                <div class="input">
                    <img src="../Assets/email.png" alt =""/>
                    <input type="email" id="email" name="email" placeholder="Email" required />
                    <span id='errorMessage'></span>
                </div>
                <div class="input">
                    <img src="../Assets/password.png" alt =""/>
                    <input type="password" id="password" name="mot_de_passe" placeholder="Mot de passe" required />
                </div>
                </div>
                <div class="buttonContainer">
                    <input type="submit" class="submit"/>
                </div>
        </div>
        <p class="loginText">Si vous avez un compte cliquez <a href="../Login/login.php">ici</a> pour vous connecter </p>
    </form>
    
</body>
</html>