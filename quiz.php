<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест</title>
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

    // Получение ID теста из параметров URL
    $testId = $_GET['test_id'];

    // Получение информации о выбранном тесте
    $sql = "SELECT * FROM tests WHERE id = '$testId'";
    $result = mysqli_query($connection, $sql);
    $test = mysqli_fetch_assoc($result);

    // Получение всех вопросов для выбранного теста
    $sql = "SELECT * FROM questions WHERE test_id = '$testId'";
    $result = mysqli_query($connection, $sql);
    $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<hr>

<center>
    <h1><?php echo $test['test_name']; ?></h1>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($test['cover_image']); ?>" alt="Cover Image" class="cover-image" width = 100px height = 100px>
    <form action="results.php" method="post">
        <input type="hidden"  name="test_id" value="<?php echo $testId; ?>">
        <?php foreach ($questions as $question) { ?>
            <div class="question-container">
                <h2><?php echo $question['question']; ?></h2>
                <label>
                    <input type="radio" class = vvariants name="answer_<?php echo $question['id']; ?>" value="1">
                    <?php echo $question['answer1']; ?>
                </label>
                <label>
                    <input type="radio" name="answer_<?php echo $question['id']; ?>" value="2">
                    <?php echo $question['answer2']; ?>
                </label>
                <label>
                    <input type="radio" name="answer_<?php echo $question['id']; ?>" value="3">
                    <?php echo $question['answer3']; ?>
                </label>
                <label>
                    <input type="radio" name="answer_<?php echo $question['id']; ?>" value="4">
                    <?php echo $question['answer4']; ?>
                </label>
            </div>
        <?php } ?>
        <button type="submit" class="submit-test">Завершить тест</button>
    </form>
</center>

</body>
</html>