
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire d'informations utilisateur</title>
    <!-- Link to Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- Link to jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Link to intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
</head>
<body class="bg-green-100 mt-8">
<div class="text-center">
<h2 class="text-4xl font-semibold mb-4">Étape N°2</h2>
<p class="text-lg text-gray-700 mb-4">  Les données doivent être correctes</p>
</div>

<div class="container mx-auto mt-5 p-4 bg-white rounded shadow-lg max-w-md">
    <h2 class="text-xl font-semibold mb-4 text-green-700">Formulaire d'informations Client</h2>

    <!-- User information collection form -->
    <form id="userForm" method="post"action="print_reservation.php">
        <!-- First Name -->
        <div class="mb-4">
            <label for="firstName" class="block text-sm text-gray-600">Prénom :</label>
            <input type="text" class="form-input w-full border-green-500" id="firstName" name="firstName" placeholder="votre prenom" required>
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label for="lastName" class="block text-sm text-gray-600">Nom :</label>
            <input type="text" class="form-input w-full border-green-500" id="lastName" name="lastName" placeholder="votre nom" required>
        </div>

        <!-- Car Matricule -->
        <div class="mb-4">
            <label for="carMatricule" class="block text-sm text-gray-600">Immatriculation de la voiture :</label>
            <input type="text" class="form-input w-full border-green-500" id="carMatricule" name="carMatricule" placeholder="1111-A-11" required>
        </div>

        <!-- Phone Number with Country Code Dropdown -->
        <div class="mb-4">
            <label for="phoneNumber" class="block text-sm text-gray-600">Numéro de téléphone :</label>
            <input type="tel" class="form-input w-full border-green-500" id="phoneNumber" name="phoneNumber" placeholder="06XXXXXXXX" required>
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm text-gray-600">Adresse e-mail :</label>
            <input type="email" class="form-input w-full border-green-500" id="email" name="email" placeholder="exemple@gmail.com" required>
        </div>

        <!-- Submission Button -->
        <button type="submit" name="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Suivant</button>
    </form>

    <!-- intl-tel-input script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- Ajax Script -->
    <script>
        // Initialize intl-tel-input
        var input = document.querySelector("#phoneNumber");
        var iti = window.intlTelInput(input, {
            preferredCountries: ["fr", "us", "gb", "ca", "de"], // Adjust as needed
            separateDialCode: true,
            initialCountry: "ma" // Set default country
        });



    </script>
</div>

</body>
</html>
