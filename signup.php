<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>تسجيل جديد</title>
    <link rel="stylesheet" href='first.css'>
</head>

<body dir='rtl' class="text">
    <div class="formdiv">
        <form method="POST" action='signup.php'>
            <ul>
                <label for="username">اسم المستخدم: </label>
                <li><input class="text" type='text' name='username' id='username' value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>" required></li>
                <br>
                <label for="password">الاسم: </label>
                <li><input class="text" type='text' name='name' id='name' required></li>
                <br>
                <label for="password">كلمة المرور: </label>
                <li><input class="text" type='password' name='password' id='password' required><br><input type="checkbox" onclick="toggle()">أظهر</li>
                <br>
            </ul>
            <input class="text" type="submit" value="تسجيل">
        </form>
    </div>
    <a href="login.php">تسجيل الدخول</a>

    <!-- FORM PARAMETERS VALIDATION -->
    <?php
    require_once('database.php');
    /**
     * Checks if the given parameters are set by post method, if not then call die.
     * @param $pars the set of parameters to be checked.
     */

    function arePOSTparametersset($pars)
    {
        foreach ($pars as $p) {
            if (!isset($_POST[$p])) {
                die("العامل $p ينبغي تحديد قيمته باستخدام طريقة post.");
            }
        }
    }

    //arePOSTparametersset(['username', 'password', 'name']);



    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password'])) :
        $un = $_POST['username'];
        $name = $_POST['name'];
        $pw =  $_POST['password'];

        if (!ctype_alnum($un)) {
            die("<p class='error'><span style='color: blue'>($un)</span> اسم مستخدم غير صالح <br>اقتصر في اسم المستخدم على الأرقام والحروف الإنجليزية</p>");
        }
        if (strlen($un) < 5) {
            die("<p class='error'><span style='color: blue'>($un)</span> اسم مستخدم غير صالح <br>لا ينبغي أن يقل طول اسم المستخدم عن 5 أحرف</p>");
        }

        if (strlen($pw) < 3) {
            die("<p class='error'>كلمة سر ضعيفة <br> قوّها بزيادة طولها.</p>");
        }

        $db = new DbAuthService();
        if ($db->userExists($un)) {
            echo '<p class="error">اسم مستخدم محجوز</p>';
        } else {
            $db->addUser($un, $name, $pw);
        }
    endif;
    ?>

    <script>
        // js script to toggle between shown and obscured password on clicking a checkbox.
        function toggle() {
            var pwbox = document.getElementById('password');
            pwbox.type = (pwbox.type == 'password') ? 'text' : 'password';
        }
    </script>
</body>

</html>