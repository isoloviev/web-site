<?php
include_once('stuff.php');

// проверим не авторизованы ли мы
if (!isset($_SESSION['user'])) {
    include_once('login.php');
    exit;
}

$activeMenu = "subscribers";

include_once('tpl_header.php');
?>

    <h1>Подписки</h1>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $q = 1;
        foreach (getListOfSubscribes() as $item) {
            ?>
            <tr>
                <td><?php echo $item['listid'] ?></td>
                <td><?php echo $item['listname'] ?></td>
                <td>
                    <a href="?id=<?php echo $item['listid'] ?>" class="btn btn-default btn-xs"><span
                            class="glyphicon glyphicon-pencil"></span></a>
                    <a href="?delete=<?php echo $item['listid'] ?>" class="btn btn-danger btn-xs"><span
                            class="glyphicon glyphicon-remove"></span></a>
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