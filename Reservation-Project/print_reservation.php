<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <!-- Link to SweetAlert CSS and JavaScript -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <!-- Link to Bootstrap CSS and JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Link to Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Add your custom styles for the reservation card here -->
    <style>
        .reservation-card {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 50px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .warning {
            color: red;
        }
        .b
    </style>
</head>

<body>

<?php
session_start();

if (isset($_POST['submit'])) {
    // Get reservation information from session
    $visitType = $_SESSION['visitType'];
    $horseNumber = $_SESSION["horseNumber"];
    $selectedDateTime = $_SESSION["selectedDateTime"];

    // Get user information from the form
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $carMatricule = $_POST["carMatricule"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];

    // Insert data into the database (customize table and column names)
    include 'dbconnection.php';
    try {
        $sql = "INSERT INTO reservations (nom_client, prenom_client, numero_matricule, numero_telephone, email, date_heure_reservation,type_visite,nombre_chevaux) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $firstName, $lastName, $carMatricule, $phoneNumber, $email, $selectedDateTime,$visitType,$horseNumber);
        $stmt->execute();
        $stmt->close();

        // Show designed SweetAlert prompt
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Votre réservation est complète avec succès!',
                text: 'Merci pour votre confiance.',
                timer: 3000,
                showConfirmButton: false
            })
        </script>
    ";
        session_destroy();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => "An error occurred."]);
        exit();
    }
}
?>

<!-- Your reservation card HTML goes here -->
<div class="container reservation-card bg-white p-8 shadow-md flex flex-col items-center">
    <!-- Logos -->
    <div class="flex justify-between mb-4">
        <img src="ghriss.png" alt="Logo 1" class="logo">
        <img src="dekra.png" alt="Logo 2" class="logo">
    </div>

    <!-- Additional Information -->
    <p class="text-sm mb-4">
        Viste technique Dekra Demnate Imlil<br>
        Chef centre: Lahcen Chkarka<br>
        Email: lahcen@hotmail.com
    </p>

    <!-- User Information -->
    <h2 class="text-lg font-semibold mb-4">Informations utilisateur</h2>
    <p>Nom: <?php echo $firstName; ?></p>
    <p>Prénom: <?php echo $lastName; ?></p>
    <p>Immatriculation de la voiture: <?php echo $carMatricule; ?></p>
    <p>Numéro de téléphone: <?php echo $phoneNumber; ?></p>
    <p>Email: <?php echo $email; ?></p>

    <!-- Visit Information -->
    <h2 class="text-lg font-semibold mt-4">Récapitulatif de la réservation</h2>
    <p>Type de visite: <?php echo $visitType; ?></p>
    <p>Nombre de chevaux: <?php echo $horseNumber; ?></p>
    <p>Date et heure du rendez-vous: <?php echo $selectedDateTime; ?></p>

    <!-- Warning -->
    <p class="warning mt-4">
        NB: Si vous souhaitez annuler votre réservation, appelez-nous au téléphone +212 6888888888.<br>
        Veuillez venir avant l'heure par 15 minutes.
    </p>

    <!-- Print button for printing the reservation card -->
    <button onclick="printReservation()" class="btn btn-primary mt-4">Imprimer la réservation</button>
</div>

<!-- JavaScript function for printing the reservation card -->
<script>
    function printReservation() {
        // Add logic for printing the reservation card
        window.print();

        // Redirect to home.php after printing
        window.location.href = 'home.php';
    }
</script>

</body>

</html>
