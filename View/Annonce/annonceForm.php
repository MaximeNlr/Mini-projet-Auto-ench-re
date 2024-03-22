<?php
session_start();
    if (!isset($_SESSION['id_utilisateur']) || $_SESSION['id_utilisateur'] === null) {
        header('Location: ../View/Signup/signup.php');
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
</head>
<body>
    <h1>Publication de voiture à vendre</h1>
    <form action="../../Model/annonceData.php" method="post" enctype="multipart/form-data">
        <label for="image">Image :</label>
        <input type="file" id="image" name="image"><br>

        <label for="titre">titre :</label>
        <input type="text" id="titre" name="titre" required><br>

        <label for="model">Modèle :</label>
        <input type="text" id="model" name="model" required><br>

        <label for="marque">Marque :</label>
        <input type="text" id="marque" name="marque" required><br>

        <label for="puissance">Puissance :</label>
        <input type="number" id="puissance" name="puissance" required><br>

        <label for="annee">Année de mise en circulation :</label>
        <input type="text" id="annee" name="annee" required><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

        <label for="prix_depart">Prix de départ :</label>
        <input type="numer" id="prix_depart" name="prix_depart" required><br>

        <label for="date_expiration">Date d'expiration :</label>
        <input type="date" id="date_expiration" name="date_expiration" required><br>

        <input type="hidden" name="date_publication" value="<?php echo date('Y-m-d H:i:s'); ?>">

        <input type="submit" value="Publier">
    </form>
</body>
</html>
