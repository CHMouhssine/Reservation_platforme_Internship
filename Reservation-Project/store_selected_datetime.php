<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectedDateTime"])) {
    $selectedDateTime = $_POST["selectedDateTime"];

    // Validate and format the datetime string (replace this with your validation logic)
    $formattedDateTime = date("Y-m-d H:i:s", strtotime($selectedDateTime));

    $_SESSION["selectedDateTime"] = $formattedDateTime;
    echo "Selected DateTime stored successfully: " . $_SESSION["selectedDateTime"];
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Error storing the selected date and time.";
}
?>
