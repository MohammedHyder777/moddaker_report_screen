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

        $current_user = new User($_SESSION['username']);

        echo " مرحبا بـ" . $current_user->name . ' في صفحة التقارير 2';
        echo "<br>نوع المستخدم: " . $current_user->type;
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

    <script src="/jquery/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(
            $('div.am5-tooltip-container').empty()
        )
    </script>
</body>

</html>