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

        $url = 'http://localhost/moodle/mapi/api.php?function=country';
        $countryurl = "https://moddaker.com/birmingham/webservice/rest/server.php?wstoken=6205b87bf70f63264e85e23200a67b88&wsfunction=core_user_get_users&moodlewsrestformat=json&criteria[0][key]=lastname&criteria[0][value]=%25";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        
        curl_close($curl);
        $result = json_decode($response, true);
        
        for ($i=0; $i < count($result); $i++) { 
            $row = $result[$i];
            $result[$i]['country'] = $string["$row[country]"];
        }
        // $i = 0;
        // foreach ($result as $row) {
        //     $row['country'] = $string["$row[country]"];
        //     $result[$i] = $row;
        //     $i++;
        // }
        // echo '<div dir="ltr">';
        // print_r($result);
        // echo '</div>';
    }
    ?>
    
    <div class="chartsPanel">
        <div class="chartCard" id="chartdiv" style="width: 50%;"></div>

        <?php if ($current_user->type == 'مدير نظام') : ?>
            <a href="#" onclick="toggleFullscreen('chartdiv2')">O</a>
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

    <script>
        // Reading country_data from php:
        var result = <?php echo json_encode($result);?>;
        // // var country_data = JSON.parse(result);
        var country_data = [];
        for (const key in result) {
            if (result.hasOwnProperty.call(result, key)) {
                country_data.push(result[key]);
            }
        }
        console.log(result)
        console.log(country_data)
        
        
        
        
        // محاولة غير ناجحة
        // var country_data = [];
        // async function getcountry_data(url) {
            //     let response = await fetch(url);
            //     console.log(response.json())
            //     return response.json();  // 
            // }
            
            
            // getcountry_data('http://localhost/moodle/mapi/api.php').then(
                //     (response) => {
                    //         country_data = response;
                    //     }
                    // );
                    // console.log(country_data)
                    </script>
    
    <script src="report_charts.js"></script>

    <script src="/jquery/jquery-3.6.1.min.js"></script>

    <script>
    $(document).ready(
        $('.chartCard').each(function () {
            setFont(this);
        })
    )

    function setFont(mychart) {
            descendants = [...mychart.getElementsByTagName('*')];
            // console.log(typeof descendants);

            descendants.forEach(element => {
                if (element.hasChildNodes()) {
                    setFont(element)
                } else {
                    element.style.fontFamily = 'arabic typesetting'
                    element.style.fontSize = 'small'
                    element.style.overflow = 'auto'
                    element.style.margin = 'auto'
                    // element.style.backgroundColor = 'red'
                }
            });
        }
    
</script>
</body>

</html>