<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='first.css'>
    <title>حذف مستخدم</title>
</head>

<body dir='rtl' class="text">
    <?php
    include 'header.php';
    if (isset($_GET['username'])) {
        echo '<p class="error">';
        echo 'أترغب حقا في محو بيانات المستخدم '.$_GET['username'].'؟';
        echo '</p>';
    }
    ?>
    
</body>
</html>