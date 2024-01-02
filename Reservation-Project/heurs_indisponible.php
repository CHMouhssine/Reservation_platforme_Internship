<?php include 'dbconnection.php' ?>
<?php
// Logique pour récupérer les créneaux de réservation depuis la base de données


// Récupérer la date spécifique du frontend (par exemple, envoyée par la requête AJAX)
$date = $_GET['date']; // Assurez-vous de valider et de nettoyer cette valeur

// Vérifier si le jour sélectionné est un samedi ou un dimanche
$dayOfWeek = date('N', strtotime($date));
if ($dayOfWeek == 6 || $dayOfWeek == 7) {
    // C'est un samedi ou un dimanche, renvoyer une réponse vide ou un message approprié
    echo json_encode([]);
    exit;
}

// Création de plages horaires disponibles pour la journée spécifiée
$availableSlots = array();

// Définir les heures souhaitées
$desiredHours = array('09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30');

foreach ($desiredHours as $hour) {
    $startDateTime = date('Y-m-d H:i:s', strtotime("$date $hour:00")); // Heure de début du créneau
    $endDateTime = date('Y-m-d H:i:s', strtotime("$date $hour:30")); // Heure de fin du créneau

    // Vérifier si des réservations existent pour le créneau
    $sqlCheckReservation = "SELECT COUNT(*) AS count FROM reservations WHERE date_heure_reservation >= ? AND date_heure_reservation < ?";
    $stmtCheckReservation = $conn->prepare($sqlCheckReservation);
    $stmtCheckReservation->bind_param("ss", $startDateTime, $endDateTime);
    $stmtCheckReservation->execute();
    $stmtCheckReservation->bind_result($count);
    $stmtCheckReservation->fetch();
    $stmtCheckReservation->close();

    if ($count == 0) {
        $availableSlots[] = array(
            'id' => uniqid(),
            'title' => 'Disponible',
            'start' => $startDateTime,
            'end' => $endDateTime,
            'color' => '#00ff00', // Couleur verte pour les créneaux disponibles
        );
    } else {
        $availableSlots[] = array(
            'id' => uniqid(),
            'title' => 'Indisponible',
            'start' => $startDateTime,
            'end' => $endDateTime,
            'color' => '#ff0000', // Couleur rouge pour les créneaux indisponibles
        );
    }
}

echo json_encode($availableSlots);

$conn->close();
?>
