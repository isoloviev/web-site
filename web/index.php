<?php
include_once('stuff.php');

// проверим не авторизованы ли мы
if (!isset($_SESSION['user'])) {
    include_once('login.php');
    exit;
}

$activeMenu = "index";

// если авторизованы, выведем список пользователей
include_once('tpl_header.php');
?>


    <h1>Пользователи</h1>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Адрес эл. почты</th>
            <th>Имя</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $q = 1;
        foreach(getListOfUsers() as $item) {
            ?>
            <tr>
                <td><?php echo $q?></td>
                <td><?php echo $item['email']?></td>
                <td><?php echo $item['realname']?></td>
                <td>
                    <a href="?id=<?php echo $item['email']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="?delete=<?php echo $item['email']?>" class="btn btn-danger btn-xs" <?=($item['email'] == $_SESSION['user']['email'] ? 'disabled' : '')?>><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
            <?php
            $q++;
        }
        ?>
        </tbody>

    </table>

<?php
include_once('tpl_footer.php');