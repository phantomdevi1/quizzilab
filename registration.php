<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы регистрации
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Подключение к базе данных
    $host = 'localhost';
    $db   = 'quizzylab';
    $user = 'root';
    $pass = 'root';
    $charset = 'utf8mb4';

    // Установка соединения с базой данных
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $conn = mysqli_connect($host, $user, $pass, $db);

    // Проверка соединения
    if (!$conn) {
        die("Ошибка подключения к базе данных: " . mysqli_connect_error());
    }

    // Проверка наличия пользователя с таким же именем
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Пользователь с таким именем уже зарегестрирован.");</script>';
    } else {
        // Добавление нового пользователя в базу данных
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Вы зарегестрированы");</script>';
        } else {
            echo '<script>alert("Ошибка регистрации");</script>';
        }
    }

    // Закрытие соединения с базой данных
    mysqli_close($conn);
}
?>
<header>
   <center>
    <a class="text_header" href="authorization.php">QuizzyLab</a>    
    </center>
</header>

<div class="registration_div" id="block5">

 

<form method="POST" action="">
   <div class="content_authorization">
        <center>       
            <h2>Регистрация</h2>
        </center>

       <input type="text" id="username" name="username" required>
       <input type="password" id="password" name="password" required>    
       <div class="flex_column">
       <input type="submit" name="submit" value="Зарегестрироваться" class="registr_btn_input">
       <a href="authorization.php" class="close_reg">Отмена</a>
       </div>

      </div>
   </div>
</body>
</html>