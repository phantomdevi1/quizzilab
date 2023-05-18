<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>  
<?php
// Подключение к базе данных
$host = 'localhost';
$db   = 'quizzylab';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

// Установка соединения с базой данных
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$conn = mysqli_connect($host, $user, $pass, $db);

// Проверка соединения
if (!$conn) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Обработка входных данных и сообщение об ошибке
$error = '';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Запрос к базе данных для проверки данных
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      header('Location: main_tesmaker.php');
      exit;
    } else {
      echo '<script>alert("Неверное имя пользователя или пароль.");</script>';
    }
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>  
<header>
   <center>
    <a class="text_header">QuizzyLab</a>    
    </center>
</header>

 <div class="authorization_div" id="block5">

 

 <form method="POST" action="">
    <div class="content_authorization hidden" id="content_authorizationid">
    
        <h2>Вход</h2>
        <input type="text" id="username" name="username" required>
        <input type="password" id="password" name="password" required> 
        <div class="flex">
        <button onclick="showBlock()" class="close_input">Отмена</button>
        <input type="submit" name="submit" value="Войти" class="input_btn">
        </div> 
        <a href="registration.php" class="reg_btn_skip">Регистрация</a>
          
       </div>
    </div>

<div class="content_auto">

   

    <div class="column">
    <div class="testtaker" id="block1">
        <a href="main_testtaker.php" ></a>
        
    </div>
    <div class="testtaker_info" id="block2">
    <span>TestTaker</span>   
        </div>
     </div>

     <div class="column">
    <div class="testmaker" id="block3" onclick="showBlock()">
    <span href=""></span>    
    </div>
    <div class="testmaker_info" id="block4">
    <span>TestMaker</span>
    </div>
</div>
</div>





<script>
var block1 = document.getElementById("block1");
var block2 = document.getElementById("block2");
var block3 = document.getElementById("block3");
var block4 = document.getElementById("block4");

// Добавляем обработчик события наведения мыши на блок1
block1.addEventListener("mouseover", function() {
  block2.style.display = "flex";
});


block1.addEventListener("mouseout", function() {  
  block2.style.display = "none";
});

block3.addEventListener("mouseover", function() {  
  block4.style.display = "flex";
});

block3.addEventListener("mouseout", function() { 
  block4.style.display = "none";
});


function showBlock() {
  var block5 = document.getElementById("block5");

  // Проверяем текущее состояние block5
  if (block5.classList.contains("hidden")) {
    // Если block5 скрыт, показываем его
    block5.classList.remove("hidden");

    // Добавляем обработчик события клика на весь документ
    document.addEventListener("click", closeBlockOutside);
  } else {
    // Если block5 отображается, скрываем его
    block5.classList.add("hidden");

    // Удаляем обработчик события клика
    document.removeEventListener("click", closeBlockOutside);
  }
}

function closeBlockOutside(event) {
  var block5 = document.getElementById("block5");
  var content = document.getElementById("content");

  // Проверяем, был ли клик сделан внутри block5 или его содержимого
  if (!block5.contains(event.target) && !content.contains(event.target)) {
    // Если клик сделан вне block5, скрываем его
    block5.classList.add("hidden");

    // Удаляем обработчик события клика
    document.removeEventListener("click", closeBlockOutside);
  }
}





</script>
</body>
</html>