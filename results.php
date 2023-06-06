<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты</title>
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

    // Получение ID теста из параметров формы
    $testId = $_POST['test_id'];

    // Получение информации о выбранном тесте
    $sql = "SELECT * FROM tests WHERE id = '$testId'";
    $result = mysqli_query($connection, $sql);
    $test = mysqli_fetch_assoc($result);

    // Получение всех вопросов для выбранного теста
    $sql = "SELECT * FROM questions WHERE test_id = '$testId'";
    $result = mysqli_query($connection, $sql);
    $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Подсчет результатов
    $totalQuestions = count($questions);
    $correctAnswers = 0;

    foreach ($questions as $question) {
        $questionId = $question['id'];
        $selectedAnswer = $_POST['answer_' . $questionId];
        $correctAnswer = $question['correct_answer'];

        if ($selectedAnswer == $correctAnswer) {
            $correctAnswers++;
        }
    }

    // Рассчет процента правильных ответов
    $percentage = ($correctAnswers / $totalQuestions) * 100;
    
    // Получение имени пользователя из параметров формы
    $username = $_POST['username_quiz'];
    
    // Сохранение результатов в базу данных
    $insertSql = "INSERT INTO results (username, test_name, correct_answers, total_questions, percentage) 
                  VALUES ('$username', '{$test['test_name']}', '$correctAnswers', '$totalQuestions', '$percentage')";
    $insertResult = mysqli_query($connection, $insertSql);
    if (!$insertResult) {
        die("Ошибка при сохранении результатов: " . mysqli_error($connection));
    }
?>

<hr>

<center>
    <div class="content_result">
    <h1>Итоги</h1>
    <h2>Результаты теста "<?php echo $test['test_name']; ?>"</h1>
    <h2>Имя пользователя: <?php echo $username; ?></h2>
    <h2 class="kolvo_answer-h2">Колличество правильных ответов: <span class="correctanswers-result"> <?php echo $correctAnswers; ?>/<?php echo $totalQuestions; ?> </span></h2> 
    <h2>Процент правильных ответов: <?php echo $percentage; ?>%</h2>

    

        <?php
            $grade = '';
            
            if ($percentage > 80) {
                $grade = '5';
            } elseif ($percentage > 65) {
                $grade = '4';
            } elseif ($percentage > 45) {
                $grade = '3';
            } elseif ($percentage > 30 or $percentage < 45) {
                $grade = '2';
            } else {
                $grade = '2';
            }
            
            echo '<h2>Оценка: ' . $grade . '</h2>';
        ?>
    
        <a class="more_test" href="main_testtaker.php">Пройти ещё тест!</a>
    </div>
</center>

    
</center>


</body>
</html>
