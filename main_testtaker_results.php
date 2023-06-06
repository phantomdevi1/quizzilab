<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все результаты</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
   <center>
    <a class="text_header" href="authorization.php">QuizzyLab</a>
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

    // Получение всех результатов прохождения тестов из базы данных
    $sql = "SELECT * FROM results";
    $result = mysqli_query($connection, $sql);
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<center>
    <div class="content_result">
    <h1>Все результаты</h1>
    
    <?php foreach ($results as $result) { ?>
        <div class="result-card">
            <h2>Результаты теста "<?php echo $result['test_name']; ?>"</h2>
            <h2>Имя пользователя: <?php echo $result['username']; ?></h2>
            <h2>Количество правильных ответов: <?php echo $result['correct_answers']; ?>/<?php echo $result['total_questions']; ?></h2>
            <h2>Процент правильных ответов: <?php echo $result['percentage']; ?>%</h2>
            <hr>
        </div>
    <?php } ?>
    
    <a class="back-link" href="main_tesmaker.php">Вернуться</a>
    </div>
</center>

</body>
</html>

