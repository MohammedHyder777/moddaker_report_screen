<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>شاشة التقارير 2</title>
    <link rel="stylesheet" href='first.css'>


</head>

<body dir='rtl' class="text">
    <?php
    include 'header.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    } else {
        include 'dbauth.php';
        include 'user_model.php';
        include 'countries.php';

        $current_user = new User($_SESSION['username']);

        echo " مرحبا بـ" . $current_user->name . ' في صفحة التقارير 2';
        echo "<br>نوع المستخدم: " . $current_user->type . '<br>';

        $url = 'http://localhost/moodle/mapi/api.php';

        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);

        for ($i=0; $i < count($result); $i++) { 
            $row = $result[$i];
            $result[$i]['country'] = $string["$row[country]"];
            if ($result[$i]['country'] == '') {
                unset($result[$i]);
            }
        }
        // $i = 0;
        // foreach ($result as $row) {
        //     $row['country'] = $string["$row[country]"];
        //     $result[$i] = $row;
        //     $i++;
        // }
        print_r($result);
    }
    ?>
    <div class="chartsPanel">
        <div class="chartCard" id="chartdiv" style="width: 50%;"></div>

        <?php if ($current_user->type == 'مدير نظام') : ?>
            <div class="chartCard" id="chartdiv2" style="width: 50%;"></div>
        <?php endif; ?>
    </div>

    <div class="chartsPanel">
        <div class="chartCard" id="chartCard3" style="width: 50%;">
            <div id="chartdiv3"></div>
        </div>

        <?php if ($current_user->type == 'مدير نظام') : ?>
            <div class="chartCard" id="chartdiv4" style="width: 50%;"></div>
        <?php endif; ?>
    </div>

    <script type="text/javascript" src="/moddaker_report_screen/amcharts5/index.js"></script>
    <script type="text/javascript" src="/moddaker_report_screen/amcharts5/percent.js"></script>
    <script type="text/javascript" src="/moddaker_report_screen/amcharts5/xy.js"></script>
    <script type="text/javascript" src="/moddaker_report_screen/amcharts5/themes/Animated.js"></script>

    <script src="report_charts.js"></script>

    <!-- <script src="/jquery/jquery-3.6.1.min.js"></script> -->
</body>

</html>