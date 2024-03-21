<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once "vehicule.class.php";
        // Récupération des données du formulaire
        $titre = $_POST['titre'];
        $model = $_POST['model'];
        $marque = $_POST['marque'];
        $puissance = $_POST['puissance'];
        $annee = $_POST['annee'];
        $description = $_POST['description'];
        $prix_depart = $_POST['prix_depart'];

        // recupération du fichier l'image
        $image = $_FILES['image'];

        // le chemin de déstination pour l'enregistrement de l'image
        $targetDir = "image/";
        $targetFile = $targetDir . basename($image['name']);

        // déplacement du fichier télecharger vers le dossier de destination
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            echo "L'image a été télécharger avec succès. ";
        } else { 
            echo 'ERREUR lors du télechargement de image';
        }

        $date_expiration = $_POST['date_expiration'];
        
        try {
            // Connexion à la base de données
            $pdo = new PDO('mysql:host=localhost;dbname=ddb_v_enchere', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation de la requête d'insertion
            $query = "INSERT INTO vehicule (titre, model, marque, puissance, annee, description, prix_depart, image_path, date_expiration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);

            // Exécution de la requête
            $stmt->execute([$titre, $model, $marque, $puissance, $annee, $description, $prix_depart, $targetFile, $date_expiration]);
            

            echo '<div class="message"><p>Article publier !</p>
                                <p>Vous allez etre redirigé</p>
                            </div>
                            <script>setTimeout(function() {window.location.href = "../Home/index.php";}, 3000);</script>';
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Redirection vers le formulaire si la méthode n'est pas POST
        header('Location: annonceform.php');
    }
?>
