<?php
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($hashed_password && password_verify($password, $hashed_password)) {
        echo "Вход выполнен! Добро пожаловать, $username. <a href='index.html'>Перейти</a>";
    } else {
        echo "Неверное имя пользователя или пароль. <a href='login.html'>Попробовать снова</a>";
    }
    $stmt->close();
}
$conn->close();
?>


























