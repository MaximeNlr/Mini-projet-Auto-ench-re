<?php
session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once "../Controller/vehicule.class.php";
        $titre = $_POST['titre'];
        $model = $_POST['model'];
        $marque = $_POST['marque'];
        $puissance = $_POST['puissance'];
        $annee = $_POST['annee'];
        $description = $_POST['description'];
        $prix_depart = $_POST['prix_depart'];

        $image = $_FILES['image'];
        
        $targetDir = "../../View/images/";
        $targetFile = $targetDir . basename($image['name']);
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            echo "L'image a été télécharger avec succès. ";
        } else { 
            echo 'ERREUR lors du télechargement de image';
        }

        $date_expiration = $_POST['date_expiration'];

        if(isset($_SESSION['id_utilisateur'])) {
            $userId = $_SESSION['id_utilisateur'];
            var_dump($userId);
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=bdd_auto_enchere', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO vehicule (id_utilisateur, titre, model, marque, puissance, annee, description, prix_depart, image_path, date_expiration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);

            $stmt->execute([$userId, $titre, $model, $marque, $puissance, $annee, $description, $prix_depart, $targetFile, $date_expiration]);
            

            echo '<div class="message"><p>Article publier !</p>
                                <p>Vous allez etre redirigé</p>
                            </div>
                            <script>setTimeout(function() {window.location.href = "../View/Home/index.php";}, 3000);</script>';
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        header('Location: ../View/Annonce/annonceform.php');
    }
}
?>
