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
?>

<hr>

<center>
    <h1>Результаты теста "<?php echo $test['test_name']; ?>"</h1>
    <h2>Правильных ответов: <?php echo $correctAnswers; ?>/<?php echo $totalQuestions; ?></h2>
    <h2>Процент правильных ответов: <?php echo $percentage; ?>%</h2>
</center>

</body>
</html>
