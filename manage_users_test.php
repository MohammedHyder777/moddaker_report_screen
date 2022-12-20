<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='first.css'>
    <title>إدارة المستخدمين 2</title>
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
    
    $url = 'http://localhost/moodle/mapi/api.php';

    $curl = curl_init($url);
    curl_setopt_array($curl, [
        // CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true
        ]); // If this option (CURLOPT_RETURNTRANSFER) is not set to true the response will not be decoded to an array using json_decode;
    $response = curl_exec($curl);
	curl_close($curl);
    $response = "$response";

    // $response = file_get_contents($url);
	$result = json_decode($response, true);

    echo "<div dir = 'ltr'>";
    print_r($result);
    echo "</div>";
    echo sizeof($result);
    ?>
    <table>
        <tr>
            <th>اسم المستخدم</th>
            <th>الاسم</th>
            <th>رتبة المستخدم</th>
            <th colspan="2">العمليات</th>
        </tr>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['user_type']?></td>
                <td><a href="#">عدّل بياناته</a></td>
                <td><a class = "error" href="<?php echo "delete_user.php?username=$row[username]"; ?>">حذف</a></td>
            </tr>
        <?php } ?>
    </table>


</body>

</html>