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

    $bdd = new PDO('mysql:host=localhost;dbname=bdd_auto_enchere', 'root', 'root');
    $query = $bdd->prepare('SELECT id_utilisateur, pseudo_utlisateur, nom, prenom; FROM Utilisateur WHERE id_utilisateur = :userId')
    $query -> param(':userId', $userId);
    $query -> execute();

    $userData = $query->fetch(PDO::FETCH_ASSOC);

    if ($userData) {
        echo '<form action="profile.php" method="POST">';
        echo '<p>Votre nom : <input type="text" name="nom" value="' . $userData['nom'] . '"></p>';
        echo '<p>Votre prénom : <input type="text" name="prenom" value="' . $userData['prenom'] . '"></p>';
        echo '<p>Votre email : <input type="text" name="pseudo_utilisateur" value="' . $userData['pseudo_utilisateur'] . '"></p>';
        echo '<p>Votre mot de passe : <input type="password" name="password" value="*******"></p>';
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