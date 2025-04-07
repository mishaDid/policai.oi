<?php
$servername = "localhost"; // Адрес сервера MySQL
$username = "root";        // Имя пользователя MySQL (обычно root)
$password = "";            // Пароль пользователя MySQL (обычно пустой для локальной установки)
$dbname = "users_system";  // Название базы данных

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка на успешное подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
