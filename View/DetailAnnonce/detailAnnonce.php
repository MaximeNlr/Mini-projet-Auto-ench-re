<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detailAnnonce.css"/>
    <title>Détails de l'annonce - VIP ENCHERE</title>
    <link rel="icon" type="image/png" href="../../View/images/logo1.png" />
</head>
<header>
<header>
    <img src="../../View/images/logo1.png" alt="Logo">
    <div class="headerContainer">
    <a href="../../View/Annonce/annonceForm.php">Publier
        <?php if(isset($_SESSION['id_utilisateur']) && $_SESSION['id_utilisateur'] !== null): ?>
            <a href="../../View/profile.view.php">Profil</a>
            <a href="../../Model/logout.php">Se deconnecter</a>
        <?php else: ?>
            <a href="../../View/Signup/signup.php">Inscription / Connexion</a>
        <?php endif; ?>   
    </div>
</header>
</header>
<body>
    <?php
        if (isset($_GET['id_vehicule']) && !empty($_GET['id_vehicule'])) {
            $annonce_id = $_GET['id_vehicule'];

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=bdd_auto_enchere', 'root', 'root');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT * FROM vehicule WHERE id_vehicule = ?";
                $stmt = $pdo->prepare($query);

                $stmt->execute([$annonce_id]);

                if ($stmt->rowCount() > 0) {
                    $annonce = $stmt->fetch(PDO::FETCH_ASSOC);

                    $prix_depart = $annonce['prix_depart'];

                    echo "<div class='ClassArticle'>";
                    echo "<h1>Détails de l'annonce</h1>";
                    echo "<img src='../AnnonceForm/" . htmlspecialchars($annonce['image_path']) . "' alt='Image du véhicule'>";
                    echo "<p><strong>Titre :</strong> " . htmlspecialchars($annonce['titre']) . "</p>";
                    echo "<p><strong>Modèle :</strong> " . htmlspecialchars($annonce['model']) . "</p>";
                    echo "<p><strong>Marque :</strong> " . htmlspecialchars($annonce['marque']) . "</p>";
                    echo "<p><strong>Puissance :</strong> " . htmlspecialchars($annonce['puissance']) . "</p>";
                    echo "<p><strong>Année :</strong> " . htmlspecialchars($annonce['annee']) . "</p>";
                    echo "<p><strong>Description :</strong> " . htmlspecialchars($annonce['description']) . "</p>";
                    echo "<p><strong>Valeur actuel :</strong> " . htmlspecialchars($annonce['prix_depart']) . " €</p>";
                    echo "<p><strong>Fin de l'enchère :</strong> " . htmlspecialchars($annonce['date_expiration']) . "</p>";
                    echo "</div>";
                   
                    echo "<form action='../../Model/enchere_data.php' method='post'>";
                    echo "<label for='nouveau_prix'>Nouvelle somme :</label>";
                    echo "<input type='number' id='nouveau_prix' name='nouveau_prix' min='" . $prix_depart . "' required>";
                    echo "<input type='hidden' name='annonce_id' value='" . htmlspecialchars($annonce_id) . "'>";
                    echo "<button type='submit' name='submit_enchere'>Enchérir</button>";
                    echo "</form>";

                } else {
                    echo "Aucune annonce trouvée avec cet identifiant.";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            
            header("Location: ../View/Home/index.php"); 
            exit(); 
        }
    ?>
</body>
</html>

