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
        $question = $_POST['question'];
        $answer1 = $_POST['answer1'];
        $answer2 = $_POST['answer2'];
        $answer3 = $_POST['answer3'];
        $answer4 = $_POST['answer4'];
        $correctanswer = $_POST['correct_answer'];
        $user_id = 1;
        
    
        // Загрузка обложки теста
        if ($_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $coverImage = addslashes(file_get_contents($_FILES['cover_image']['tmp_name']));
        } else {
            // Путь к дефолтной картинке
            $defaultCoverImage = 'img/default_test.png';
            $coverImage = addslashes(file_get_contents($defaultCoverImage));
        }
    
        $sql = "INSERT INTO tests (user_id, test_name, question, answer1, answer2, answer3, answer4, correct_answer, cover_image)
        VALUES ('$user_id', '$testname', '$question', '$answer1', '$answer2', '$answer3', '$answer4', '$correctanswer', '$cover_image')";
    
        if (mysqli_query($connection, $sql)) {
            echo "Тест успешно создан!";
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
    <textarea name="question" id="question" cols="30" rows="10" class="" placeholder="Напишите вопрос"></textarea>
    <h2 class="title_answer-testmaker">Добавьте варианты ответов</h2>

    <label for="answer1">Вариант ответа 1:</label>
        <input type="text" name="answer1" id="answer1"><br>

        <label for="answer2">Вариант ответа 2:</label>
        <input type="text" name="answer2" id="answer2"><br>

        <label for="answer3">Вариант ответа 3:</label>
        <input type="text" name="answer3" id="answer3"><br>

        <label for="answer4">Вариант ответа 4:</label>
        <input type="text" name="answer4" id="answer4"><br><br>

    <label for="correct_answer">Правильный ответ:</label>
       
        <select name="correct_answer">
            <option value="1">Ответ 1</option>
            <option value="2">Ответ 2</option>
            <option value="3">Ответ 3</option>
            <option value="4">Ответ 4</option>
        </select>
        

       

        <button type="submit">Создать тест</button>
</form>
</div>
</center>
    
</body>
</html>