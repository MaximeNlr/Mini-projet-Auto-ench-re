<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nouveauPrix = $_POST['nouveau_prix'];
    $annonceId = $_POST['annonce_id'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ddb_v_enchere', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "UPDATE vehicule SET prix_depart = ? WHERE id_vehicule = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nouveauPrix, $annonceId]);

        echo json_encode(['success' => true, 'nouveau_prix' => $nouveauPrix]);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour du prix : ' . $e->getMessage()]);
        exit();
    }
} else {
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
           
                alert("Le prix a été mis à jour avec succès !");
                
                setTimeout(function() {
                    window.location.href = "../View/Home/index.php"; 
                }, 3000); 
            } else {
                
                alert("Erreur : " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la mise à jour du prix :', error);
        });
    });
</script>


