<?php
session_start();
// Vérifiez si les variables de session existent
if (isset($_POST['submit'])) {
    $_SESSION["horseNumber"]=$_POST['horseNumber'];
    $_SESSION["visitType"]=$_POST['visitType'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calendrier des réservations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.0/dist/fullcalendar.min.css">
</head>
<body>

<nav class="bg-blue-500 p-4 text-white">
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold">Votre Nom de Service</h1>
    </div>
</nav>

<!-- Contenu de la page du calendrier -->
<div class="container mx-auto mt-8">
    <div class="text-center">
        <h2 class="text-4xl font-semibold mb-4">Étape N°2</h2>
        <p class="text-lg text-gray-700 mb-4">  Sélectionner le jour et l'heure</p>
        <!-- Calendrier FullCalendar -->
        <div id="calendar" style="max-width: 600px; margin: auto; background-color: #f8f9fa;"></div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: 'heurs_indisponible.php', // URL pour récupérer les créneaux indisponibles depuis le backend
            dateClick: function (info) {
                const clickedDate = info.dateStr;
                const currentDate = new Date().toISOString().split('T')[0];

                // Check if the clicked date is today or a future date
                if (clickedDate >= currentDate) {
                    // Check if the clicked date is a weekend (Saturday or Sunday)
                    const dayOfWeek = new Date(clickedDate).getDay();
                    if (dayOfWeek === 0 || dayOfWeek === 6) {
                        alert("Nous sommes fermées le samedi et le dimanche.");
                    } else {
                        // Fetch availability and update the calendar
                        fetch('heurs_indisponible.php?date=' + clickedDate)
                            .then(response => response.json())
                            .then(data => {
                                // Clear existing events and render new ones
                                calendar.getEvents().forEach(event => event.remove());
                                calendar.addEventSource(data);
                                calendar.render();
                            });
                    }
                } else {
                    // Show warning for past dates
                    alert("Vous ne pouvez pas choisir une date passée. Veuillez choisir une date future.");
                }
            },
            eventClick: function (info) {
                const selectedDateTime = info.event.start.toLocaleString();
                const isAvailable = info.event.backgroundColor === '#00ff00';

                // Check if the clicked time slot is available
                if (isAvailable) {
                    // Use Bootstrap modal for confirmation
                    $('#confirmationModal').modal('show');
                    // Set the selected date and time in the modal
                    $('#selectedDateTime').text(selectedDateTime);
                    // Handle 'Accepter' click in the modal
                    $('#accepterBtn').on('click', function () {
                        console.log('Button clicked');
                        $.ajax({
                            url: 'store_selected_datetime.php',
                            method: 'POST',
                            data: { selectedDateTime: selectedDateTime },
                            success: function(response) {
                                // Redirigez vers une nouvelle page PHP si la requête a réussi
                                window.location.href = 'info_client.php';
                            },
                            error: function() {
                                alert('Erreur lors du stockage de la date et de l\'heure sélectionnées.');
                            }
                        });
                    });
                } else {
                    // Show warning for unavailable time slot
                    alert("Ce créneau n'est pas disponible. Veuillez choisir un autre créneau.");
                }
            }
        });
        calendar.render();
    });
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation de réservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous réserver ce créneau le <span id="selectedDateTime"></span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                <button type="button" class="btn btn-primary" id="accepterBtn">Oui</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
