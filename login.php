<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href='first.css'>
</head>

<body dir='rtl' class="text">
    <form method="POST" action='login.php'>
        <ul>
            <label for="username">اسم المستخدم: </label>
            <li><input class="text" type='text' name='username' id='username' value="<?php echo (isset($_POST['username']))? $_POST['username']:''; ?>" required></li>
            <br>
            <label for="password">كلمة المرور: </label>
            <li><input class="text" type='text' name='password' id='password'></li>
            <br>
        </ul>
        <input class="text" type="submit" value="تسجيل">
    </form>

    <a href="signup.php">تسجيل حساب جديد</a>

    <?php
    if(isset($_POST['username'])  && isset($_POST['password'])):
        $un = $_POST['username'];
        $pw = $_POST['password'];
        require_once 'database.php';
        $db = new DbAuthService();
        if ($db->userExists($un)) {
            $dk_pw = $db -> getPassword($un);
            // password_verify is a built in function compares the user given plain pw with the hashed pw stored in the db.
            if (password_verify($pw, $dk_pw)) {
                // echo '<p class="messge">اسم مستخدم صحيح<br> كلمة مروره: '.$dk_pw.'</p>';
                session_start();
                $_SESSION['username'] = $un;
                header('location: home.php');
                
            } else {
                echo '<p class="error">كلمة مرور خاطئة</p>';
            }
        } else {
            echo '<p class="error">اسم مستخدم غير مسجل امش سجّل</p>';
        }
    endif;
    ?>
</body>
</html>