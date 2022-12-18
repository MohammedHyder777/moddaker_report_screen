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


    <script type="text/javascript" src="/moddaker_report_screen/amcharts5/index.js"></script>
    <script type="text/javascript" src="/moddaker_report_screen/amcharts5/percent.js"></script>
    <script type="text/javascript" src="/moddaker_report_screen/amcharts5/themes/Animated.js"></script>

    <script>
        // Instantiating the chart:
        var root = am5.Root.new("chartdiv");
        var chart = root.container.children.push(
            am5percent.PieChart.new(root, {})
        );

        // // Hide the amCharts logo
        // if (chart.logo) {
        //     chart.logo.disabled = true;
        // }
        // chart.logo.disabled = true;
        // Adding series. Pie chart supports one series type: PieSeries
        var myseries = chart.series.push(
            am5percent.PieSeries.new(root, {
                name: "Series",
                categoryField: "country",
                valueField: "students"
            })
        );

        // set themes:
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        // animation
        myseries.animate({
            key: "startAngle",
            from: 270,
            to: 630,
            loops: 1,
            duration: 2000,
            easing: am5.ease.inOut(am5.ease.cubic) // linear (Constant speed during all duration) - circle - cubic elastic - ...
        });

        // Colors: Wherever you need to specify a color in amCharts 5 you need to pass in a Color object.
        /* A color set comes with a pre-defined list of colors, depending on the theme we are using (if any).

        There is a number of ways to override the list as needed.

        The most easiest way is to simply set its colors setting to an array of Color objects as done below. Another option is to modify default theme.
        */
        // myseries.set("fill", am5.color('#ff0000'));
        // chart.get("colors").set("colors", [
        //     am5.color(0x095256),
        //     am5.color(0x087f8c),
        //     am5.color(0x5aaa95),
        //     am5.color(0x86a873),
        //     am5.color(0xbb9f06)
        // ]);

        // The data is set directly on series via its data property:
        data = [{
            country: "السودان",
            students: 3000
        }, {
            country: "السعودية",
            students: 3000
        }, {
            country: "مصر",
            students: 3000
        }]

        myseries.data.setAll(data);

        // Admin dedicated charts: //////////////////////////////////////////////////////////////////////
        var root2 = am5.Root.new("chartdiv2");
        var chart2 = root2.container.children.push(
            am5percent.PieChart.new(root2, {
                layout: root2.verticalLayout,
                innerRadius: am5.percent(50)
            })
        );

        // Adding series. Pie chart supports one series type: PieSeries
        var myseries2 = chart2.series.push(
            am5percent.PieSeries.new(root2, {
                name: "Series",
                categoryField: "country",
                valueField: "students",

            })
        );

        root2.setThemes([
            am5themes_Animated.new(root2)
        ]);

        myseries2.animate({
            key: "startAngle",
            from: 270,
            to: 630,
            loops: 1,
            duration: 2000,
            easing: am5.ease.inOut(am5.ease.cubic) // linear (Constant speed during all duration) - circle - cubic elastic - ...
        });

        myseries2.data.setAll(data);
        /* WARNING 1:  It's a good practice to make sure that setting data happens as late into code as possible. Once you set data, all related objects are created, 
        so any configuration settings applied afterwards might not carry over.

        WARNING 2: 
        // ERROR: the following will result in error
        var root = new am5.Root("chartdiv");
        // SUCCESS: this is correct
        var root = am5.Root.new("chartdiv");
        This true not just for Root but for every single class in amCharts 5.

        WARNING 3:
        root.dispose();
        Trying to create a new root element in a <div> container before disposing the old one that is currently residing there, will result in an error.
        */
    </script>
</body>

</html>