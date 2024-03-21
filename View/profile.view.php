<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    include './Model/get.user.data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if ($userData) {
        echo '<form action="../profile.php" method="POST">';
        echo '<p>Votre nom : <input type="text" name="nom" value="' . $userData['nom'] . '"></p>';
        echo '<p>Votre prénom : <input type="text" name="prenom" value="' . $userData['prenom'] . '"></p>';
        echo '<p>Votre pseudo : <input type="text" name="pseudo_utilisateur" value="' . $userData['pseudo_utilisateur'] . '"></p>';
        echo '<p>Votre mot de passe : <input type="password" name="password" value="*******"></p>';
        echo '<input type="submit"/>';
        echo '</form>';
    } else {
        echo '<p>Aucune donnée utilisateur trouvée.</p>';
    }
?>
</body>
</html>