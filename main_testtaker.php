<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
   <center>
    <a class="text_header">QuizzyLab</a>
    </center>
</header>
<?php
    // Параметры подключения к базе данных
    $host = 'localhost';
    $dbName = 'quizzylab';
    $username = 'root';
    $password = 'root';

    // Подключение к базе данных
    $connection = mysqli_connect($host, $username, $password, $dbName);
    if (!$connection) {
        die("Ошибка подключения к базе данных: " . mysqli_connect_error());
    }

    // Получение всех тестов из базы данных
    $sql = "SELECT * FROM tests";
    $result = mysqli_query($connection, $sql);
    $tests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Обработка формы отправки теста
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Код для создания теста и вставки данных в БД

        // ... (код для создания теста и вставки данных в БД)

        // Перенаправление на страницу результатов
        header("Location: results.php?test_id=$testId");
        exit;
    }
?>



<hr>

<!-- Вывод всех созданных тестов -->
<center>
    <h1>Список тестов</h1>
    <ul class="invisible-marker">
        <?php foreach ($tests as $test) { ?>
            <li>
                <a href="quiz.php?test_id=<?php echo $test['id']; ?>"><?php echo $test['test_name']; ?></a>
            </li>
        <?php } ?>
    </ul>
</center>

</body>
</html>