<?php
include_once('stuff.php');

$error = null;

// ищем в пост данных адрес эл почты
if (isset($_POST['email'])) {
    if(empty($_POST['password'])) {
        $error = "Введите пароль";
    }
    elseif (!preg_match("/\A(\w){6,20}\Z/", $_POST['password'])) {
        $error="Пароль слишком короткий! Пароль должен быть не менее 6 символов!";
    }
    elseif(empty($_POST['password2'])) {
        $error = "Введите подтверждение пароля!";
    }
    elseif($_POST['password'] != $_POST['password2']) {
        $error = "Введенные пароли не совпадают!";
    }
    elseif(empty($_POST['email'])) {
        $error = "Введите E-mail!";
    }
    elseif (!preg_match("/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/", $_POST['email'])) {
        $error = "E-mail имеет недопустимий формат! Например, name@gmail.com!";
    }

    else{
        $password = $_POST['password'];
        $mdPassword = md5($password);
        $email = $_POST['email'];
        $name = $_POST['name'];


        $query2 = ("SELECT email FROM subscribers WHERE email='$email'");
        $sql = mysql_query($query2) or die(mysql_error());
        if (mysql_num_rows($sql) > 0){
            $error = "Пользователь с таким e-mail уже зарегистрирован!";
        }
        else{
            $query = "INSERT INTO subscribers (password, email, realname )
							  VALUES ('$mdPassword', '$email', '$name')";
            $result = mysql_query($query) or die(mysql_error());;
            header("Location: index.php?reg=1");
            exit;

        }
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

    <title>Регистрация</title>

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

        .form-signin input {
            margin-bottom: 10px;
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
        <h2 class="form-signin-heading">Регистрация</h2>
        <?php
        if ($error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
        ?>
        <label for="inputEmail" class="sr-only">Эл. почта</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Эл. почта" required
               autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
        <label for="inputPassword2" class="sr-only">Пароль еще раз</label>
        <input type="password" id="inputPassword2" name="password2" class="form-control" placeholder="Повторите пароль" required>
        <label for="inputName" class="sr-only">Ваше имя</label>
        <input type="text" id="inputName" name="name" class="form-control" placeholder="Ваше имя" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Регистрация</button>
        <p class="text-center" style="margin-top: 15px;"><a href="index.php">Вернуться на главную страницу</a></p>
    </form>

</div>
<!-- /container -->


</body>
</html>
