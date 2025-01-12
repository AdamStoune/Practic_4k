<?php
// Проверка, был ли отправлен запрос методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $product = $_POST['product'];
    $comment = $_POST['comment'];

    // Данные для подключения к базе данных
    $host = 'localhost'; // Адрес сервера
    $dbname = 'rental_console'; // Имя базы данных
    $user = 'root'; // Ваше имя пользователя
    $password = ''; // Ваш пароль

    try {
        // Создаем соединение с базой данных
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        // Устанавливаем режим обработки ошибок
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // SQL-запрос для вставки данных в таблицу contact_requests
        $sql = "INSERT INTO contact_requests (name, phone, address, product, comment)
                VALUES (:name, :phone, :address, :product, :comment)";
        
        // Подготовка запроса
        $stmt = $pdo->prepare($sql);
        
        // Выполнение запроса
        $stmt->execute([
            ':name' => $name,
            ':phone' => $phone,
            ':address' => $address,
            ':product' => $product,
            ':comment' => $comment,
        ]);

        // Вывод сообщения об успешной отправке
        echo "Ваш запрос успешно отправлен! <a href='index.html'>Перейти</a>";
    } catch (PDOException $e) {
        // Если ошибка при подключении или запросе
        echo "Ошибка подключения: " . $e->getMessage();
    }
}
?>