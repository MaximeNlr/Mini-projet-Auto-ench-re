<?php
// Vérifiez si les données du formulaire sont envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez la nouvelle somme et l'identifiant de l'annonce
    $nouveauPrix = $_POST['nouveau_prix'];
    $annonceId = $_POST['annonce_id'];

    try {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=ddb_v_enchere', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Mettre à jour le prix de l'article dans la base de données
        $query = "UPDATE vehicule SET prix_depart = ? WHERE id_vehicule = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nouveauPrix, $annonceId]);

        // Envoyer une réponse à la page précédente pour mettre à jour le prix affiché
        echo json_encode(['success' => true, 'nouveau_prix' => $nouveauPrix]);
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, envoyer une réponse avec un message d'erreur
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour du prix : ' . $e->getMessage()]);
        exit();
    }
} else {
    // Si les données du formulaire ne sont pas envoyées, renvoyer une erreur
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue']);
    exit();
}
?>

<script>
    document.getElementById("form_enchere").addEventListener("submit", function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        
        fetch('<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Afficher un message de succès à l'utilisateur
                alert("Le prix a été mis à jour avec succès !");
                
                // Rediriger l'utilisateur vers la page principale après quelques secondes
                setTimeout(function() {
                    window.location.href = "index.php"; // Remplacez "index.php" par l'URL de votre page principale
                }, 3000); // Redirection après 3 secondes (3000 millisecondes)
            } else {
                // Afficher un message d'erreur en cas d'échec
                alert("Erreur : " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la mise à jour du prix :', error);
        });
    });
</script>


