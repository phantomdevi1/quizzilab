<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .content_main_testtaker {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .test-card {
        width: 200px;
        margin: 10px;
        padding: 20px;
        text-align: center;
        border-radius: 20px;
        border: 2px solid transparent; 
    }

    .test-card:hover {
        border-color: #90C1FC; 
    }

    .test-card img {
        width: 200px;
        height: 200px;
    }

    </style>
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

<!-- Вывод всех созданных тестов -->
<center><h1>Список тестов</h1>
        
    <div class="content_main_testtaker">
        
        <?php foreach ($tests as $test) { ?>
            <div class="test-card">
                <a class="name_test-testtaker" href="quiz.php?test_id=<?php echo $test['id']; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($test['cover_image']); ?>" alt="Cover Image">
                    <p><?php echo $test['test_name']; ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
</center>

</body>
</html>
