<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <!-- Liens vers les bibliothèques Bootstrap et Tailwind -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- Script reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        /* Styles personnalisés ici */
        body {
            background-color: #f0f8ff; /* Couleur de fond personnalisée */
        }

        /* Style du formulaire */
        #reservationForm {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        /* Bouton Vérifier le Prix */
        #verifyPriceButton {
            background-color: #28a745; /* Couleur verte personnalisée */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #verifyPriceButton:hover {
            background-color: #218838; /* Couleur verte plus foncée au survol */
        }

        /* Bouton Suivant */
        #nextButton {
            background-color: #007bff; /* Couleur bleue personnalisée */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #nextButton:hover {
            background-color: #0056b3; /* Couleur bleue plus foncée au survol */
        }
    </style>
</head>
<body>


<div class="container mx-auto mt-8">
    <div class="text-center">
        <h2 class="text-4xl font-semibold mb-2">Etape N°1</h2>
        <p class="text-lg text-gray-700 mb-4">Choisir le type et le nombre de chevaux de votre véhicule</p>
        <!-- Formulaire de réservation -->
        <form id="reservationForm" action="calender.php" method="POST">
            <label for="visitType">Type de visite :</label>
            <select name="visitType" id="visitType" class="form-control mb-2" required>
                <option value="periodique">Périodique</option>
                <option value="volontaire">Volontaire</option>
                <option value="mutation">Mutation</option>
                <option value="complementaire">Complémentaire</option>
            </select>

            <label for="horseNumber">Nombre de chevaux :</label>
            <input type="number" name="horseNumber" id="horseNumber" class="form-control mb-2" min="1" required>

            <!-- Bouton Vérifier le Prix -->
            <button type="button" id="verifyPriceButton" onclick="fetchPrice()">Vérifier le Prix</button>

            <!-- Bouton Suivant -->
            <button type="submit" name="submit" id="nextButton">Suivant</button>
        </form>

        <!-- Affichage du résultat du prix -->
        <p id="priceResult" class="mt-4"></p>
    </div>
</div>


<script>
    function fetchPrice() {
        // Logique pour récupérer le prix depuis le backend
        const visitType = document.getElementById("visitType").value;
        const horseNumber = document.getElementById("horseNumber").value;
        const priceResult = document.getElementById("priceResult");

        // Requête AJAX pour vérifier le prix
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Afficher le résultat dans la page
                priceResult.innerHTML = xhr.responseText;
            }
        };

        xhr.open("POST", "verifie_prix.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("visitType=" + visitType + "&horseNumber=" + horseNumber);
    }
</script>

</body>
</html>
