<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sprawdź, czy hasła się zgadzają
    if ($_POST['password'] != $_POST['confirm_password']) {
        die("Hasła się nie zgadzają.");
    }

    // Wygenerowanie tokenu aktywacyjnego
    $token = bin2hex(random_bytes(50));

    // Połączenie z bazą danych
    $conn = new mysqli('localhost', 'root', '', 'gufciomc');
    if ($conn->connect_error) {
        die("Połączenie nieudane: " . $conn->connect_error);
    }

    // Wstawienie danych użytkownika do bazy danych
    $sql = "INSERT INTO users (username, email, password, token) VALUES ('$username', '$email', '$password', '$token')";
    if ($conn->query($sql) === TRUE) {
        // Wysłanie e-maila z linkiem aktywacyjnym
        $to = $email;
        $subject = "Potwierdzenie rejestracji na GufcioMC";
        $message = "Kliknij poniższy link, aby aktywować swoje konto:\n\n";
        $message .= "http://twoja-strona.pl/activate.php?token=$token";

        mail($to, $subject, $message);
        echo "Sprawdź swoją skrzynkę e-mail, aby aktywować konto.";
    } else {
        echo "Błąd: " . $conn->error;
    }
    $conn->close();
}
?>
