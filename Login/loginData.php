<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
            $email = $_POST['email'];
            $password = $_POST['mot_de_passe'];

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=ddb_v_enchere', 'root', '');
                $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT * FROM Utilisateur WHERE email = ?";
                $stmt = $pdo -> prepare($query);
                $stmt -> execute([$email]);
                $user = $stmt -> fetch(PDO::FETCH_ASSOC);

                if($user && password_verify($password, $user['mot_de_passe'])) {
                    $_SESSION['email'] = $user;

                    echo '<div class="message">Connexion réussie !</br>
                            <p>Vous allez etre redirigé</p>
                        </div>
                        <script>setTimeout(function() {window.location.href = "./index.php";}, 3000);</script>';
                } else {
                    $_SESSION['error_message'] = "L'email et/ou le mot de passe sont incorrects. Veuillez réessayer.";
                }
            } catch (PDOException $e) {
                echo "Erreur : " .$e -> getMessage();
            }
        } else {
            header('location: ../Login/login.php');
        }
    }
?>