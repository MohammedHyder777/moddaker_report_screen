<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>تسجيل جديد</title>
    <link rel="stylesheet" href='first.css'>
</head>

<body dir='rtl' class="text">

    <?php 
    $error_messeges = ['username' => '', 'password' => '', 'name' => ''];
    require_once('dbauth.php');


    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password'])) :
        $un = htmlspecialchars($_POST['username']);
        $name = $_POST['name'];
        $pw =  $_POST['password'];

        if (!ctype_alnum($un)) {
            $error_messeges['username'] = "<p class='error'><span style='color: blue'>($un)</span> اسم مستخدم غير صالح <br>اقتصر في اسم المستخدم على الأرقام والحروف الإنجليزية</p>";
        }
        if (strlen($un) < 5) {
            $error_messeges['username'] = "<p class='error'><span style='color: blue'>($un)</span> اسم مستخدم غير صالح <br>لا ينبغي أن يقل طول اسم المستخدم عن 5 أحرف</p>";
        }

        if (strlen($pw) < 3) {
            $error_messeges['password'] = "<p class='error'>كلمة سر ضعيفة <br> قوّها بزيادة طولها.</p>";
        }
        if (!array_filter($error_messeges)) { // if there are no errors array_filter will return false.
            $db = new DbAuthService();
            if ($db->userExists($un)) {
                $error_messeges['username'] = '<p class="error">اسم مستخدم محجوز</p>';
            } else {
                echo $db->addUser($un, $name, $pw);
            }
        }
    endif;
    ?>

    
    <div class="formdiv">
        <form class="form" method="POST" action='signup.php'>
            <ul>
                <label for="username">اسم المستخدم: </label>
                <li><input class="text" type='text' name='username' id='username' value="<?php echo (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : ''; ?>" required></li>
                <div><?php echo $error_messeges['username'] ?></div>
                <br>
                <label for="name">الاسم: </label>
                <li><input class="text" type='text' name='name' id='name' required></li>
                <br>
                <label for="password">كلمة المرور: </label>
                <li><input class="text" type='password' name='password' id='password' required><br><input type="checkbox" onclick="toggle()">أظهر</li>
                <div><?php echo $error_messeges['password'] ?></div>
                <br>
            </ul>
            <input class="text" type="submit" value="تسجيل">
        </form>
        <a href="login.php">تسجيل الدخول</a>
    </div>


    
    <script>
        // js script to toggle between shown and obscured password on clicking a checkbox.
        function toggle() {
            var pwbox = document.getElementById('password');
            pwbox.type = (pwbox.type == 'password') ? 'text' : 'password';
        }
    </script>
</body>

<!-- <script>window.location='http://localhost/firstphp/first.php'</script> -->
</html>