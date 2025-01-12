<?php
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Хэшируем пароль

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Регистрация прошла успешно! <a href='index.html'>Перейти</a>";
    } else {
        echo "Ошибка: имя пользователя уже существует. <a href='register.html'>Попробовать снова</a>";
    }
    $stmt->close();
}
$conn->close();
?>