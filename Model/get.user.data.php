<?php
if (isset($_SESSION['id_utilisateur'])) {
    $userId = $_SESSION['id_utilisateur'];

    $bdd = new PDO('mysql:host=localhost;dbname=ddb_v_enchere', 'root', '');
    $query = $bdd->prepare('SELECT id_utilisateur, pseudo_utilisateur, nom, prenom FROM Utilisateur WHERE id_utilisateur = :userId');
    $query->bindParam(':userId', $userId);
    $query->execute();

    $userData = $query->fetch(PDO::FETCH_ASSOC);
    header('location: ./View/profile.view.php')
} else {
    $userData = false;
}
?>