<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>�������� ����</title>
</head>
<body>
    <h1>�������� ���� "<?php echo $_GET['test_name']; ?>"</h1>
    <form action="submit_test.php" method="post">
        <input type="hidden" name="test_id" value="<?php echo $_GET['test_id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
        <h2><?php echo $question; ?></h2>
        <input type="radio" name="answer" value="1"><?php echo $answer1; ?>

        <input type="radio" name="answer" value="2"><?php echo $answer2; ?>

        <input type="radio" name="answer" value="3"><?php echo $answer3; ?>

        <input type="radio" name="answer" value="4"><?php echo $answer4; ?>

        <button type="submit">��������� �����</button>
    </form>
</body>
</html>

?
<?php
    // ��������� ����������� � ���� ������
    $host = 'localhost';
    $dbName = 'quizzylab';
    $username = 'root';
    $password = 'root';

    // ����������� � ���� ������
    $connection = mysqli_connect($host, $username, $password, $dbName);
    if (!$connection) {
        die("������ ����������� � ���� ������: " . mysqli_connect_error());
    }

    // ������ � ���� ������
    $sql = "SELECT * FROM tests";
    $result = mysqli_query($connection, $sql);

    // ����� ������
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<h2>" . $row["test_name"] . "</h2>";            echo "<p>" . $row["question"] . "</p>";
            echo "<a href='test.php?test_id=" . $row["id"] . "&user_id=1&test_name=" . $row["test_name"] . "'>������ ����</a>";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($connection);
?>
