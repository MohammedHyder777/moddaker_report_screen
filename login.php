<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href='first.css'>
</head>

<body dir='rtl' class="text">
<?php
    $error_messeges = ['username' => '', 'password' => ''];
    if (isset($_POST['username'])  && isset($_POST['password'])) :
        $un = $_POST['username'];
        $pw = $_POST['password'];
        require_once 'dbauth.php';
        try {
            $db = new DbAuthService();
        } catch (\Throwable $th) {
            die('مشكلة في الاتصال بقاعدة البيانات');
        }
        
        if ($db->userExists($un)) {
            $dk_pw = $db->getPassword($un);
            // password_verify is a built in function compares the user given plain pw with the hashed pw stored in the db.
            if (password_verify($pw, $dk_pw)) {
                // echo '<p class="messge">اسم مستخدم صحيح<br> كلمة مروره: '.$dk_pw.'</p>';
                session_start();
                $_SESSION['username'] = $un;
                header('location: home.php');
            } else {
                $error_messeges['password'] = '<p class="error">كلمة مرور خاطئة</p>';
            }
        } else {
            $error_messeges['username'] = '<p class="error">اسم مستخدم غير مسجل امش سجّل</p>';
        }
    endif;
    ?>

        <div class="formdiv">
            <form method="POST" action='login.php'>
                <ul>
                    <label for="username">اسم المستخدم: </label>
                    <li><input class="text" type='text' name='username' id='username' value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>" required></li>
                    <div><?php echo $error_messeges['username'] ?></div>
                    <br>
                    <label for="password">كلمة المرور: </label>
                    <li><input class="text" type='password' name='password' id='password' required><br><input type="checkbox" onclick="toggle()">أظهر</li>
                    <div><?php echo $error_messeges['password'] ?></div>
                    <br>
                </ul>
                <input class="text" type="submit" value="دخول">
            </form>
            <a href="signup.php">تسجيل حساب جديد</a>
        </div>

    
    <script>
        // js script to toggle between shown and obscured password on clicking a checkbox.
        function toggle() {
            var pwbox = document.getElementById('password');
            pwbox.type = (pwbox.type == 'password') ? 'text' : 'password';
        }
    </script>
</body>

</html>