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

    // Установка соединения с сервером MySQL
$conn = new mysqli($servername, $username, $password);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Создание базы данных
$sql_create_database = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_database) === TRUE) {
    echo "База данных создана успешно";
} else {
    echo "Ошибка создания базы данных: " . $conn->error;
}

// Выбор базы данных
$conn->select_db($dbname);

// Обработка отправки формы добавления вопроса
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $question = $_POST["question"];
    $answers = $_POST["answers"];
    $correctAnswer = $_POST["correctAnswer"];
    
    // Вставка вопроса в таблицу "questions"
    $sql_insert_question = "INSERT INTO questions (question_text) VALUES ('$question')";
    if ($conn->query($sql_insert_question) === TRUE) {
        echo "Вопрос успешно добавлен<br>";
        
        // Получение ID вставленного вопроса
        $questionId = $conn->insert_id;
        
        // Вставка ответов в таблицу "answers"
        foreach ($answers as $index => $answer) {
            $isCorrect = ($index == $correctAnswer) ? 1 : 0;
            $sql_insert_answer = "INSERT INTO answers (question_id, answer_text, is_correct) VALUES ('$questionId', '$answer', '$isCorrect')";
            if ($conn->query($sql_insert_answer) !== TRUE) {
                echo "Ошибка добавления ответа: " . $conn->error;
                break;
            }
        }
        
        echo "Ответы успешно добавлены";
    } else {
        echo "Ошибка добавления вопроса: " . $conn->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();
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