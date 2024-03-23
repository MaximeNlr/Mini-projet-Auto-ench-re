<?php
session_start();
    if (!isset($_SESSION['id_utilisateur']) || $_SESSION['id_utilisateur'] === null) {
        header('Location: ../../View/Signup/signup.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="annonce.css"/>
    <title>Publication de voiture à vendre</title>
    <link rel="icon" type="image/png" href="../../View/images/logo1.png" />
</head>
<header>
    <img src="../../View/images/logo1.png" alt="Logo">
    <div class="headerContainer">
    <a href="../../View/Home/index.php">Accueil
        <?php if(isset($_SESSION['id_utilisateur']) && $_SESSION['id_utilisateur'] !== null): ?>
            <a href="../../View/profile.view.php">Profil</a>
            <a href="../../Model/logout.php">Se deconnecter</a>
        <?php else: ?>
            <a href="../../View/Signup/signup.php">Inscription / Connexion</a>
        <?php endif; ?>   
    </div>
</header>
<body>
    <h1>Votre annonce</h1>
    <form action="../../Model/annonce_data.php" method="post">
        <div class="formContainer">
            
                <div class="labels">
                    <label for="image">Image :</label>
                    <label for="titre">titre :</label>
                </div>
                <div class="inputs">
                    <input type="file" id="image" name="image"><br>
                    <input type="text" id="titre" name="titre" required><br>
                </div>
                <div class="labels">
                    <label for="model">Modèle :</label>
                    <label for="marque">Marque :</label>
                </div>  
                <div class="inputs">
                    <input type="text" id="model" name="model" required><br>
                    <input type="text" id="marque" name="marque" required><br>
                </div>
            
            <div class="right">
                <div class="labels">
                    <label for="puissance">Puissance :</label>
                    <label for="annee">Année de mise en circulation :</label>
                </div>  
                <div class="inputs">
                    <input type="number" id="puissance" name="puissance" required><br>
                    <input type="text" id="annee" name="annee" required><br>
                </div>
                <div class="labels">
                    <label for="prix_depart">Prix de départ :</label>
                    <label for="date_expiration">Date d'expiration :</label>
                </div>
                <div class="inputs">
                    <input type="numer" id="prix_depart" name="prix_depart" required><br>
                    <input type="date" id="date_expiration" name="date_expiration" required><br>
                </div>
                <div class="labels">
                    <label for="description">Description :</label><br>
                </div>
                    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>
                    <input type="hidden" name="date_publication" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <input type="submit" value="Publier" id="btn">
            </div>
        </div>
    </form>
</body>
</html>
