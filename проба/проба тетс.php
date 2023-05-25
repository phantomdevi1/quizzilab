<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>
<body>
    <h1>Список тестов</h1>
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
        $sql = "SELECT * FROM tests";
        $result = mysqli_query($connection, $sql);

        // Вывод тестов
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<h2>" . $row["test_name"] . "</h2>";
                echo "<a href='test.php?test_id=" . $row["id"] . "&user_id=1&test_name=" . $row["test_name"] . "'>Пройти тест</a>";
            }
        } else {
            echo "0 результатов";
        }

        mysqli_close($connection);
    ?>
</body>
</html>