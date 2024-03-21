<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'annonce - VIP ENCHERE</title>
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
            box-shadow: 0px 17px 14px -12px rgba(66, 68, 90, 1);
            border-bottom: solid 1px  #FFD700;
        }

        header img {
            width: 150px;
            height: 80px;
        }

        .ClassArticle {
            margin-top: 100px;
        }

        .ClassArticle img {
            display: block;
            margin: 0 auto;
            max-width: 80%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.1);
        }

        h1 {
            color: #fff;
            text-align: center;
        }

        form {
            margin: 0 auto;
            width: 50%;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #555;
            background-color: #333;
            color: #fff;
            transition: border-color 0.3s ease;
        }

        input[type="number"]:focus {
            border-color: #007bff;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>

<header>
    <div>
        <a href="../Home/index.php">
            <img src="../Home/img/logo1.png" alt="Logo">
        </a>
    </div>
    

    
    <div>
        
        <a href="../Login/login.php"> Profil</a>
    </div>
</header>

<body>
    <?php
        // Vérifiez si l'identifiant de l'annonce est présent dans l'URL
        if (isset($_GET['id_vehicule']) && !empty($_GET['id_vehicule'])) {
            // Récupérez l'identifiant de l'annonce depuis l'URL
            $annonce_id = $_GET['id_vehicule'];

            try {
                // Connexion à la base de données
                $pdo = new PDO('mysql:host=localhost;dbname=ddb_v_enchere', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Préparez la requête SQL pour récupérer les détails de l'annonce
                $query = "SELECT * FROM vehicule WHERE id_vehicule = ?";
                $stmt = $pdo->prepare($query);

                // Exécutez la requête avec l'identifiant de l'annonce
                $stmt->execute([$annonce_id]);

                // Vérifiez si une annonce correspondante a été trouvée
                if ($stmt->rowCount() > 0) {
                    // Récupérez les détails de l'annonce
                    $annonce = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Récupérez le prix de départ de l'article
                    $prix_depart = $annonce['prix_depart'];

                    // Affichez les détails de l'annonce
                    echo "<div class='ClassArticle'>";
                    echo "<h1>Détails de l'annonce</h1>";
                    echo "<img src='../AnnonceForm/" . htmlspecialchars($annonce['image_path']) . "' alt='Image du véhicule'>";
                    echo "<p><strong>Titre :</strong> " . htmlspecialchars($annonce['titre']) . "</p>";
                    echo "<p><strong>Modèle :</strong> " . htmlspecialchars($annonce['model']) . "</p>";
                    echo "<p><strong>Marque :</strong> " . htmlspecialchars($annonce['marque']) . "</p>";
                    echo "<p><strong>Puissance :</strong> " . htmlspecialchars($annonce['puissance']) . "</p>";
                    echo "<p><strong>Année :</strong> " . htmlspecialchars($annonce['annee']) . "</p>";
                    echo "<p><strong>Description :</strong> " . htmlspecialchars($annonce['description']) . "</p>";
                    echo "<p><strong>Prix de départ :</strong> " . htmlspecialchars($annonce['prix_depart']) . " €</p>";
                    echo "<p><strong>Date d'éxpiration :</strong> " . htmlspecialchars($annonce['date_expiration']) . "</p>";
                    echo "</div>";
                   
                    // Formulaire pour enchérir
                    echo "<form action='enchere.php' method='post'>";
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
            // Redirigez l'utilisateur s'il n'y a pas d'identifiant d'annonce dans l'URL
            header("Location: index.php"); // Redirigez vers votre page d'accueil ou une autre page appropriée
            exit(); // Assurez-vous de terminer le script après la redirection
        }
    ?>
</body>
</html>

