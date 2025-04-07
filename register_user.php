<?php
// Подключение к базе данных
$servername = "localhost"; // Адрес сервера MySQL
$username = "root";        // Имя пользователя MySQL (по умолчанию root)
$password = "";            // Пароль пользователя MySQL (по умолчанию пустой для локальной установки)
$dbname = "odessa_users";  // Название базы данных для Одессы

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Обработка формы после отправки
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Проверка, существует ли уже пользователь с таким email или логином
    $check_sql = "SELECT * FROM odessa_user_details WHERE email='$email' OR username='$username'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        echo "Пользователь с таким email или логином уже существует!";
    } else {
        // Хешируем пароль
       
        
        // Вставляем данные в таблицу odessa_user_details
        $sql = "INSERT INTO odessa_user_details (username, email, password, full_name, phone, address) 
                VALUES ('$username', '$email', '$hashed_password', '$full_name', '$phone', '$address')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Регистрация прошла успешно!";
        } else {
            echo "Ошибка: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація нового користувача</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <h2>Реєстрація нового користувача</h2>
    </div>

    <div class="main-content">
        <form action="register_user.php" method="post">
            <label for="username">Логін</label>
            <input type="text" name="username" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Пароль</label>
            <input type="password" name="password" required>

            <label for="full_name">Повне ім'я</label>
            <input type="text" name="full_name" required>

            <label for="phone">Номер телефону</label>
            <input type="text" name="phone" required>

            <label for="address">Адреса</label>
            <textarea name="address" required></textarea>

            <button type="submit">Зареєструватися</button>
        </form>
    </div>
</body>
</html>
