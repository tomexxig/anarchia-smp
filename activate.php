<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Połączenie z bazą danych
    $conn = new mysqli('localhost', 'root', '', 'gufciomc');
    if ($conn->connect_error) {
        die("Połączenie nieudane: " . $conn->connect_error);
    }

    // Sprawdź, czy token istnieje
    $sql = "SELECT * FROM users WHERE token='$token'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $sql = "UPDATE users SET active=1 WHERE token='$token'";
        if ($conn->query($sql) === TRUE) {
            echo "Konto zostało aktywowane. Możesz teraz się zalogować.";
        }
    } else {
        echo "Nieprawidłowy token.";
    }
    $conn->close();
}
?>
