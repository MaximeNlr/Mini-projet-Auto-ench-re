<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['mot_de_passe'];

        $hash = password_hash($password, PASSWORD_DEFAULT);
        


        try {

            $pdo = new PDO('mysql:host=localhost;dbname=bdd_auto_enchere', 'root', 'root');
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $req = $pdo->prepare('SELECT email FROM Utilisateur WHERE email = :email');
            $req->execute(array(':email'=>$email));
            $existingUser = $req -> fetch();

            if ($existingUser) {
                echo '<script>
                        document.getElementById("errorMessage").innerText = "Cet email est déja utilisé. Veuillez en choisir un autre."
                      </script>';
            }else {

                $query = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)";
            $stmt = $pdo -> prepare($query);
            $stmt -> execute([$nom, $prenom, $email, $hash]);

            echo '<div class="message">Inscription validée !</br>
                    <p>Vous allez etre redirigé</p>
                </div>
            <script>setTimeout(function() {window.location.href = "../index.php";}, 3000);</script>';
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
    } else {
        header('location: ../Signup/signup.php');
    }
?>
</body>
</html>



