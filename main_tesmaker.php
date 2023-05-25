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
    <style>
        .question-container {
            margin-bottom: 20px;
        }
        .question-container textarea {
            width: 100%;
        }
        .question-container label {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<header>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    
        // Получение данных из формы
        $testname = $_POST['test_name'];
        $user_id = 1;
    
        // Загрузка обложки теста
        if ($_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $coverImage = addslashes(file_get_contents($_FILES['cover_image']['tmp_name']));
        } else {
            // Путь к дефолтной картинке
            $defaultCoverImage = 'img/default_test.png';
            $coverImage = addslashes(file_get_contents($defaultCoverImage));
        }
    
        $sql = "INSERT INTO tests (user_id, test_name, cover_image) VALUES ('$user_id', '$testname', '$coverImage')";
    
        if (mysqli_query($connection, $sql)) {
            $testId = mysqli_insert_id($connection); // Получаем ID только что созданного теста
    
            // Добавление вопросов и ответов в базу данных
            for ($i = 1; $i <= 10; $i++) {
                $question = $_POST['question' . $i];
                $answer1 = $_POST['answer' . $i . '_1'];
                $answer2 = $_POST['answer' . $i . '_2'];
                $answer3 = $_POST['answer' . $i . '_3'];
                $answer4 = $_POST['answer' . $i . '_4'];
                $correctanswer = $_POST['correct_answer' . $i];
    
                $sql = "INSERT INTO questions (test_id, question, answer1, answer2, answer3, answer4, correct_answer)
                VALUES ('$testId', '$question', '$answer1', '$answer2', '$answer3', '$answer4', '$correctanswer')";
    
                mysqli_query($connection, $sql);
            }
    
            echo '<script>alert("Тест успешно создан!");</script>';
        } else {
            echo "Ошибка при создании теста: " . mysqli_error($connection);
        }
        

        mysqli_close($connection);
    }
    ?>
   <center>
    <a class="text_header">QuizzyLab</a>    
    </center>
</header>
<center>
<h1 class="title_testmaker">Создайте свой тест!</h1>
<div class="content_testmaker">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="text" name="test_name" id="" class="test_name" placeholder="Название теста">
    <div class="img_test-div">
        <span class="title_img_test">Обложка</span>
        <input type="file" name="cover_image" id="" class="file_img_test">
    </div>
    <br>
    <hr>
    
    <?php for ($i = 1; $i <= 10; $i++) { ?>
        <div class="question-container">
            <textarea class="textarea_question" name="question<?php echo $i; ?>" id="question<?php echo $i; ?>" cols="30" rows="10" class="" placeholder="Напишите вопрос <?php echo $i; ?>"></textarea>
            <h2 class="title_answer-testmaker">Добавьте варианты ответов для вопроса <?php echo $i; ?></h2>

            <label for="answer<?php echo $i; ?>_1">Вариант ответа 1:</label>
            <input class="answer_input" type="text" name="answer<?php echo $i; ?>_1" id="answer<?php echo $i; ?>_1"><br>

            <label for="answer<?php echo $i; ?>_2">Вариант ответа 2:</label>
            <input class="answer_input" type="text" name="answer<?php echo $i; ?>_2" id="answer<?php echo $i; ?>_2"><br>

            <label for="answer<?php echo $i; ?>_3">Вариант ответа 3:</label>
            <input class="answer_input" type="text" name="answer<?php echo $i; ?>_3" id="answer<?php echo $i; ?>_3"><br>

            <label for="answer<?php echo $i; ?>_4">Вариант ответа 4:</label>
            <input class="answer_input" type="text" name="answer<?php echo $i; ?>_4" id="answer<?php echo $i; ?>_4"><br>
            
           
            
            <label for="correct_answer<?php echo $i; ?>">Правильный ответ:</label>
            <select class="select_correct" name="correct_answer<?php echo $i; ?>">
                <option value="1">Ответ 1</option>
                <option value="2">Ответ 2</option>
                <option value="3">Ответ 3</option>
                <option value="4">Ответ 4</option>
            </select>
            <hr>
        </div>
    <?php } ?>

    <button type="submit" class="create_test">Создать тест</button>
</form>
</div>
</center>
    
</body>
</html>
