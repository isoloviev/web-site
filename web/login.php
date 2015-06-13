<?php
include_once('stuff.php');

$errored = false;

// ищем в пост данных адрес эл почты
if (isset($_POST['email'])) {
    $login = stripslashes($_POST['email']);
    $login = htmlspecialchars($login);

    $password = stripslashes($_POST['password']);
    $password = htmlspecialchars($password);


    $login = trim($login);
    $password = trim($password);

    $password = md5($password);//шифруем пароль

    $user = mysql_query("SELECT * FROM subscribers WHERE email='$login' AND password='$password'");
    $id_user = mysql_fetch_array($user);
    if (empty($id_user['email'])) {
        $errored = true;
    } else {
        $_SESSION['user'] = $id_user;
        header("Location: index.php");
        exit;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Авторизация</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: normal;
        }

        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Авторизация</h2>
        <?php
        if ($errored) {
            echo '<div class="alert alert-danger">Извините, введённый вами логин или пароль неверный</div>';
        }
        if (isset($_GET['reg'])) {
            echo '<div class="alert alert-success">Вы успешно зарегистрировались в системе</div>';
        }
        ?>
        <label for="inputEmail" class="sr-only">Эл. почта</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Эл. почта" required
               autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        <p class="text-center" style="margin-top: 15px;"><a href="reg.php">Регистрация</a></p>
    </form>

</div>
<!-- /container -->


</body>
</html>
