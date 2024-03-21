<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
            $email = $_POST['email'];
            $password = $_POST['mot_de_passe'];

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=bdd_auto_enchere', 'root', 'root');
                $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT id_utilisateur, mot_de_passe FROM Utilisateur WHERE email = ?";
                $stmt = $pdo -> prepare($query);
                $stmt -> execute([$email]);
                $user = $stmt -> fetch(PDO::FETCH_ASSOC);

                if($user && password_verify($password, $user['mot_de_passe'])) {
                    $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                    
                    echo '<div class="message"><p>Connexion réussie !</p>
                            <p>Vous allez etre redirigé</p>
                        </div>
                        <script>setTimeout(function() {window.location.href = "../View/index.php";}, 3000);</script>';
                } else {
                    $_SESSION['error_message'] = "L'email et/ou le mot de passe sont incorrects. Veuillez réessayer.";
                    header('location: ../View/Login/login.php');
                }
            } catch (PDOException $e) {
                echo "Erreur : " .$e -> getMessage();
            }
        } else {
            header('location: ../View/Login/login.php');
        }
    }
?> 
</body>
</html>

