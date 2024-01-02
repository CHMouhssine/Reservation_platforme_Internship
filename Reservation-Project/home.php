<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <!-- Liens vers les bibliothèques Bootstrap et Tailwind -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Ld77UEpAAAAAFAs_iFXis8cma-jqUMLkmAuQQkt"></script>
<style>

    #submitButton {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    #submitButton img {


        width: 30px; /* Adjust the width of the logo */

    }
</style>
</head>

<body class="bg-gray-100">

<!-- Barre de navigation -->
<nav class="bg-green-500 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <!-- Logo 1 -->
            <img src="DEKRA-logo-A75D24FA7E-seeklogo.com.png" alt="Logo 1" class="h-16.5">
        </div>
        <h1 class="text-2xl font-semibold"></h1>
        <div>
            <!-- Logo 2 -->
            <img src="dekra-3.png" alt="Logo 2" class="h-16.5">
        </div>
    </div>
</nav>

<!-- Contenu de la page d'accueil -->
<div class="container mx-auto mt-8">
    <div class="text-center">
        <h2 class="text-4xl font-semibold mb-4">Bienvenue sur Dekra Viste du contrôle technique Demnate Imlil</h2>
        <!-- About Box -->
        <div class="bg-green-100 p-4 mb-4">
            <p class="text-lg text-green-800"> À propos de nous : En 2008, la société Ghriss du contrôle technique et Dekra ont signé un contrat pour fournir des services de contrôle technique de qualité.
                Nous nous engageons à assurer la sécurité de votre véhicule en respectant les normes les plus strictes.
                Avec des années d'expérience et un personnel hautement qualifié, nous sommes fiers de garantir la satisfaction de nos clients. </p>
        </div>
        <p class="text-lg text-gray-700">Réservez votre visite technique dès maintenant.</p>
        <!-- Formulaire avec reCAPTCHA -->
        <div class="flex justify-center items-center">
            <form id="reservationForm" action="formulaire.php" method="POST" onsubmit="return validateForm();">
                <!-- Ajouter le widget reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6Ld77UEpAAAAAFAs_iFXis8cma-jqUMLkmAuQQkt"></div>
                <div id="captchaWarning" class="text-red-600 hidden">Veuillez compléter le captcha avant de continuer.
                </div>
                <!-- Bouton de soumission -->
                <button id="submitButton" type="submit"
                        class=" text-white px-6 py-3 mt-4 rounded-full hover:bg-blue-600 transition-all duration-300">
                    <img src="reservation-icon.png" alt="Logo" />
                    Faire une Réservation en ligne
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function onRecaptchaLoad() {
        // Récupérer le formulaire et le bouton de soumission
        var form = document.getElementById('reservationForm');
        var submitButton = document.getElementById('submitButton');
        var captchaWarning = document.getElementById('captchaWarning');

        // Désactiver le bouton de soumission initialement
        submitButton.disabled = true;

        // Ajouter un gestionnaire d'événement sur le changement du captcha
        grecaptcha.ready(function () {
            grecaptcha.execute('6Ld77UEpAAAAAFAs_iFXis8cma-jqUMLkmAuQQkt', { action: 'submit_form' })
                .then(function (token) {
                    // Activer le bouton de soumission lorsque le captcha est complété
                    submitButton.disabled = false;
                });
        });
    }

    function validateForm() {
        // Vérifier si le captcha a été complété
        if (!grecaptcha || !grecaptcha.getResponse()) {
            // Afficher le message d'avertissement
            document.getElementById('captchaWarning').classList.remove('hidden');
            // Empêcher la soumission du formulaire
            return false;
        } else {
            // Cacher le message d'avertissement s'il est affiché
            document.getElementById('captchaWarning').classList.add('hidden');
            // Autoriser la soumission du formulaire
            return true;
        }
    }
</script>

</body>

</html>
