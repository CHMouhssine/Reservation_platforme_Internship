<?php include 'dbconnection.php' ?>
<?php
// Logique pour gérer la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $visitType = $_POST['visitType'];
    $horseNumber = $_POST['horseNumber'];

    // Requête SQL pour obtenir le prix depuis la base de données
    $sql = "SELECT prix FROM prix_visites 
            WHERE type_visite_id = (SELECT id FROM types_visites WHERE nom = ?) 
            AND ? BETWEEN chevaux_min AND chevaux_max";

    // Utilisation des déclarations préparées pour éviter les injections SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $visitType, $horseNumber);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    echo "Le prix approximatif est : $price DH";


    // Fermer la connexion à la base de données
    $conn->close();
}

?>