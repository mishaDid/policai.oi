<?php
include('db.php');

// Обрабатываем форму после отправки
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Проверяем, существует ли уже пользователь с таким email или логином
    $check_sql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        echo "Пользователь с таким email или логином уже существует!";
    } else {
        // Хешируем пароль
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Вставляем данные в таблицу
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Регистрация прошла успешно!";
        } else {
            echo "Ошибка: " . $conn->error;
        }
    }
}



?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація користувача</title>
    <link rel="stylesheet" href="pol.css">
</head>
<body>
    <div class="header">
        <h2>Реєстрація користувача</h2>
    </div>

    <div class="main-content">
        <form action="rega.php" method="post">
            <label for="username">Логін</label>
            <input type="text" name="username" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Пароль</label>
            <input type="password" name="password" required>

            <button type="submit">Зареєструватися</button>
        </form>
    </div>
</body>
</html>
