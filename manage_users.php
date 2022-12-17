<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='first.css'>
    <title>إدارة المستخدمين</title>
</head>

<body dir='rtl' class="text">
    <?php
    include 'header.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    }

    include 'dbauth.php';
    include 'user_model.php';
    $current_user = new User($_SESSION['username']);

    if ($current_user->type != 'مدير نظام') {
        header('location: home.php');
    }
    $conn = new mysqli('localhost', 'root', '', 'temp');
    $result = $conn->query('SELECT * FROM users')->fetch_all(MYSQLI_ASSOC);
    $conn -> close();
    ?>
    <table>
        <tr>
            <th>اسم المستخدم</th>
            <th>الاسم</th>
            <th>رتبة المستخدم</th>
        </tr>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['user_type']?></td>
                <td><a href="#">عدّل بياناته</a></td>
                <td><a href="<?php echo "delete_user.php?username=$row[username]"; ?>">حذف</a></td>
            </tr>
        <?php } ?>
    </table>


</body>

</html>