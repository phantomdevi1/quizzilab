<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>�������</title>
</head>
<body>
    <h1>������ ������</h1>
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
                echo "<h2>" . $row["test_name"] . "</h2>";
                echo "<a href='test.php?test_id=" . $row["id"] . "&user_id=1&test_name=" . $row["test_name"] . "'>������ ����</a>";
            }
        } else {
            echo "0 �����������";
        }

        mysqli_close($connection);
    ?>
</body>
</html>