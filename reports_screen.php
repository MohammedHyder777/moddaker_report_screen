<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>شاشة التقارير</title>
    <link rel="stylesheet" href='first.css'>
</head>

<body dir='rtl' class="text">
    <?php
        include 'header.php';
        session_start();
        if (!isset($_SESSION['username'])) {
            header('location: login.php');
        } else {
            include 'database.php';
            include 'user_model.php';

            $current_user = new User($_SESSION['username']);

            echo " مرحبا بـ".$current_user->name.' في صفحة التقارير';
            echo "<br>نوع المستخدم: ".$current_user->type;

        }
    ?>
</body>

</html>