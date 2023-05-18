<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
<header>
<?php
    // Подключение к базе данных
    $host = 'localhost';
    $dbname = 'quizzylab';
    $username = 'root';
    $password = 'root';

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Ошибка подключения к базе данных: ' . $e->getMessage());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $question = $_POST['question'];
        $answers = [
            $_POST['answer1'],
            $_POST['answer2'],
            $_POST['answer3'],
            $_POST['answer4']
        ];
        $correctAnswer = $_POST['correctAnswer'];

        try {
            // Вставка вопроса в базу данных
            $insertQuestion = $db->prepare("INSERT INTO questions (question) VALUES (?)");
            $insertQuestion->execute([$question]);
            $questionId = $db->lastInsertId();

            // Вставка вариантов ответов в базу данных
            $insertAnswer = $db->prepare("INSERT INTO answers (question_id, answer, is_correct) VALUES (?, ?, ?)");
            foreach ($answers as $index => $answer) {
                $isCorrect = ($correctAnswer == $index + 1) ? 1 : 0;
                $insertAnswer->execute([$questionId, $answer, $isCorrect]);
            }

            echo '<script>alert("Тест создан");</script>';
        } catch (PDOException $e) {
            echo 'Ошибка при создании теста: ' . $e->getMessage();
        }
    }
    ?>

   <center>
    <a class="text_header">QuizzyLab</a>    
    </center>
</header>
<center>
<h1 class="title_testmaker">Создайте свой тест!</h1>
<div class="content_testmaker">
<form method="post" action="">
    <input type="text" name="" id="" class="test_name" placeholder="Название теста">
    <div class="img_test-div">
        <span class="title_img_test">Обложка</span>
        <input type="file" name="" id="" class="file_img_test">
    </div>
    <textarea name="question" id="question" cols="30" rows="10" class="" placeholder="Напишите вопрос"></textarea>
    <h2 class="title_answer-testmaker">Добавьте варианты ответов</h2>

    <label for="answer1">Ответ 1:</label>
        <input type="text" id="answer1" name="answer1" required>

        <br>

        <label for="answer2">Ответ 2:</label>
        <input type="text" id="answer2" name="answer2" required>

        <br>

        <label for="answer3">Ответ 3:</label>
        <input type="text" id="answer3" name="answer3" required>

        <br>

        <label for="answer4">Ответ 4:</label>
        <input type="text" id="answer4" name="answer4" required>

        <br><br>

        <label for="correctAnswer1">
            Правильный ответ:
            <input type="radio" id="correctAnswer1" name="correctAnswer" value="1" required>
        </label>

        <label for="correctAnswer2">
            <input type="radio" id="correctAnswer2" name="correctAnswer" value="2" required>
        </label>

        <label for="correctAnswer3">
            <input type="radio" id="correctAnswer3" name="correctAnswer" value="3" required>
        </label>

        <label for="correctAnswer4">
            <input type="radio" id="correctAnswer4" name="correctAnswer" value="4" required>
        </label>

        <br><br>

        <button type="submit">Создать тест</button>
</form>
</div>
</center>
    
</body>
</html>