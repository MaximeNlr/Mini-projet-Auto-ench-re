<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if (isset($_SESSION['id_utilisateur'])) {
    $userId = $_SESSION['id_utilisateur'];
    
    if ($userData) {
        echo '<form action="profile.php" method="POST">';
        echo '<p>Votre nom : <input type="text" name="nom" value="' . $userData['nom'] . '"></p>';
        echo '<p>Votre prénom : <input type="text" name="prenom" value="' . $userData['prenom'] . '"></p>';
        echo '<p>Votre email : <input type="email" name="email" value="' . $userData['email'] . '"></p>';
        echo '<p>Votre mot de passe : <input type="password" name="password" value="*******"></p>';
        echo '<input type="submit" name="update_nom" value="Modifier le nom">';
        echo '<input type="submit" name="update_prenom" value="Modifier le prenom">';
        echo '<input type="submit" name="update_email" value="Modifier l\'email">';
        echo '<input type="submit" name="update_password" value="Modifier le mot de passe">';
        echo '</form>';
    } else {
        echo '<p>Aucune donnée utilisateur trouvée.</p>';
    }
} else {
    echo '<p>Aucun utilisateur connecté.</p>';
}
?>
</body>
</html>