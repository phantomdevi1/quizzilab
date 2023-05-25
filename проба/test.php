<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['test_name']; ?></title>
</head>
<body>
    <h1><?php echo $_GET['test_name']; ?></h1>
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

        // Запрос к базе данных
        $sql = "SELECT * FROM questions WHERE test_id=" . $_GET['test_id'];
        $result = mysqli_query($connection, $sql);

        // Вывод вопросов
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<h2>" . $row["question"] . "</h2>";
                echo "<form action='submit_answer.php' method='post'>";
                echo "<input type='hidden' name='test_id' value='" . $_GET['test_id'] . "'>";
                echo "<input type='hidden' name='user_id' value='" . $_GET['user_id'] . "'>";
                echo "<input type='hidden' name='question_id' value='" . $row['id'] . "'>";
                echo "<input type='radio' name='answer' value='1'>" . $row['answer1'] . "
";
                echo "<input type='radio' name='answer' value='2'>" . $row['answer2'] . "
";
                echo "<input type='radio' name='answer' value='3'>" . $row['answer3'] . "
";
                echo "<input type='radio' name='answer' value='4'>" . $row['answer4'] . "
";
                echo "<button type='submit'>Отправить ответ</button>";
                echo "</form>";
            }
        } else {
            echo "Вопросы не найдены";
        }

        mysqli_close($connection);
    ?>
</body>
</html>