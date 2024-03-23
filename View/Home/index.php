<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css"/>
    <link rel="icon" type="image/png" href="../../View/images/logo1.png" />
    <title>V enchère</title>
</head>
<body>
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
    <main>
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=bdd_auto_enchere', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $pdo->query('SELECT * FROM vehicule ORDER BY date_expiration DESC');
            
            echo "<div class='article-container'>";
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<article class='article'>";
                echo '<div class="imgContainer"/>';
                echo "<img src='../../View/images/" . htmlspecialchars($row['image_path']) . "' alt='Image du véhicule'>";
                echo "</div>";
                echo "<h2>" . htmlspecialchars($row['titre']) . "</h2>";
                echo '<div class="valueContainer">';
                echo '<div class="valueColumn">';
                echo "<p><strong>Modèle :</strong> " . htmlspecialchars($row['model']) . "</p>";
                echo "<p><strong>Marque :</strong> " . htmlspecialchars($row['marque']) . "</p>";
                echo '</div>';
                echo '<div class="valueColumn">';
                echo "<p><strong>Puissance :</strong> " . htmlspecialchars($row['puissance']) . "ch</p>";
                echo "<p><strong>Année :</strong> " . htmlspecialchars($row['annee']) . "</p>";
                echo '</div>';
                echo "<p><strong>Fin de l'enchère :</strong> " . htmlspecialchars($row['date_expiration']) . "</p>";
                echo "<a href='../../View/DetailAnnonce/detailAnnonce.php?id_vehicule=".htmlspecialchars($row['id_vehicule'])."' class='details-button'>Détails</a>";
                echo "</div>";
                echo "</article>";
            }

            echo "</div>";
        
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        ?>
    </main>
<footer>
    VIP ENCHERE copyright © 2024
</footer>
</body>
</html>
