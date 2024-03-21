<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>V enchère</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin-top: 90px;
            padding: 0;

        }

        header {
            background-color: #333333;
            color: #ffffff;
            padding: 5px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: fixed; 
            width: 100%;
            top: 0; 
            z-index: 1000; 
            -webkit-box-shadow: 0px 17px 14px -12px rgba(66, 68, 90, 1);
            -moz-box-shadow: 0px 17px 14px -12px rgba(66, 68, 90, 1);
            box-shadow: 0px 17px 14px -12px rgba(66, 68, 90, 1);
            border-bottom: solid 1px  #FFD700;
        }

        header img {
            width: 150px;
            height: 80px;
        }
        

        footer {
            background-color: #333333;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-bottom: grey;
        }

        .article-container {
            display: flex;
            flex-wrap: wrap;
        }

        .article {
            width: calc(50% - 20px); /* La moitié de la largeur de l'écran, avec un peu de marge */
            margin: 10px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
            text-align: center; /* Centrer le texte à l'intérieur de l'article */
        }

        article {
            background-color: #222222;
            margin: 20px 0;
            padding: 20px;
            width: calc(18% - 20px); /* Pour afficher 3 articles par ligne */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        article img {
            width: 570px;
            height: auto;
            border-radius: 5px;
            max-width: 100%; /* La largeur maximale de l'image sera égale à la largeur de son conteneur */
            height: auto; /* La hauteur s'ajustera automatiquement pour conserver les proportions de l'image */
            
        }

        article h2 {
            color: #ffffff;
            border-bottom: solid 1px #FFD700;
        }

        article p {
            color: #cccccc;
        }

        .details-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .details-button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ffffff;
        }

        table th {
            background-color: #444444;
        }

        table td {
            background-color: #555555;
        }

        a {
            color: #ffffff;
            text-decoration: none;
        }

        a:hover {
            color: #cccccc;
        }

    </style>
</head>
<body>

<header>
    <div>
        <img src="../View/image/logo1.png" alt="Logo">
    </div>
    <a href="../View/annonceform.php">Publier
    <div>
        <?php if(isset($_SESSION['id_utilisateur']) && $_SESSION['id_utilisateur'] !== null): ?>
            <a href="../Model/logout.php">Se deconnecter</a>
        <?php else: ?>
            <a href="../View/Signup/signup.php">Inscription / Connexion</a>
        <?php endif; ?>   
    </div>
</header>
<body>
    <main>
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=bdd_auto_enchere', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $pdo->query('SELECT * FROM enchere ORDER BY date_expiration DESC');
            
            echo "<div class='article-container'>";
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<article class='article'>";
                echo "<img src='../AnnonceForm/" . htmlspecialchars($row['image_path']) . "' alt='Image du véhicule'>";
                echo "<h2>" . htmlspecialchars($row['titre']) . "</h2>";
                echo "<p><strong>Modèle :</strong> " . htmlspecialchars($row['model']) . "</p>";
                echo "<p><strong>Marque :</strong> " . htmlspecialchars($row['marque']) . "</p>";
                echo "<p><strong>Puissance :</strong> " . htmlspecialchars($row['puissance']) . "</p>";
                echo "<p><strong>Année :</strong> " . htmlspecialchars($row['annee']) . "</p>";
                echo "<p><strong>Description :</strong> " . htmlspecialchars($row['description']) . "</p>";
                echo "<p><strong>Prix de départ :</strong> " . htmlspecialchars($row['prix_depart']) . " €</p>";
                echo "<p><strong>Date d'éxpiration :</strong> " . htmlspecialchars($row['date_expiration']) . "</p>";
                echo "<a href='../DetailsAnnonces/detailsannonce' class='details-button'>Détails</a>"; // Corrigé ici
                echo "</article>";
            }

            echo "</div>";
        
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        ?>
    </main>
</body>
<footer>
    VIP ENCHERE copyright © 2024
</footer>

</body>
</html>
