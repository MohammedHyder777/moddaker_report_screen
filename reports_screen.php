<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>شاشة التقارير</title>
    <link rel="stylesheet" href='first.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.min.js" integrity="sha512-tQYZBKe34uzoeOjY9jr3MX7R/mo7n25vnqbnrkskGr4D6YOoPYSpyafUAzQVjV6xAozAqUFIEFsCO4z8mnVBXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.min.js" integrity="sha512-HyprZz2W40JOnIBIXDYHCFlkSscDdYaNe2FYl34g1DOmE9J+zEPoT4HHHZ2b3+milFBtiKVWb4sorDVVp+iuqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/helpers.min.js" integrity="sha512-c0j5ITIxnG5CknVw3Tl4LrXCBV6Vevg3OFbTFWnuItsDokxEix501UjCggJC2McxWe2Arq4XYJdHd0VLKUc9aQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

        echo " مرحبا بـ" . $current_user->name . ' في صفحة التقارير';
        echo "<br>نوع المستخدم: " . $current_user->type;
    }
    ?>

<div class="chartsPanel">
        <div class="chartCard" style="width: 50%; height: 100%">
            <canvas id="myChart"></canvas>
        </div>

        <?php if ($current_user->type == 'مدير نظام') : ?>
            <div class="chartCard" style="width: 50%; height: 100%">
                <canvas id="myAdminChart"></canvas>
            </div>
        <?php endif; ?>

    </div>
    <script type="text/javascript" src="/moddaker_report_screen/chart.js/Chart.bundle.min.js"></script>
    
    <script>
        const ctx = document.getElementById('myChart');

        const data = [{
                year: 2010,
                count: 10,
                color: 'red'
            },
            {
                year: 2011,
                count: 20,
                color: 'blue'
            },
            {
                year: 2012,
                count: 15,
                color: 'brown'
            },
            {
                year: 2013,
                count: 25
            },
            {
                year: 2014,
                count: 22
            },
            {
                year: 2015,
                count: 30
            },
            {
                year: 2016,
                count: 28
            },
        ];

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map((datum) => datum.year), //['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                        label: '# of Votes',
                        data: data.map((datum) => datum.count), //[1, 19, 3, 5, 2, 3],
                        backgroundColor: data.map(datum => (datum['color'] !== undefined) ? datum.color : 'green'),
                        borderWidth: 3
                    },
                    // {
                    //     label: '# of occurences',
                    //     data: [10, 5, 7, 1, 0, 2],
                    //     borderWidth: 1
                    // }
                ]
            },
            options: {
                animation: {
                    duration: 2500
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: false,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false // default to true
                    },
                    tooltip: {
                        enabled: true // default to true
                    },
                    datalabels: {
                        display: true,
                        formatter: (value) => {
                            return value;
                        },
                    }
                },

            }
        });

        // Admin charts:
        var ctx2 = document.getElementById('myAdminChart');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['sat', 'sun', 'mon', 'tue', 'wed', 'thu'],
                datasets: [{
                    label: '# working hours',
                    data: [4, 7, 3, 9, 4, 5, 5],
                    backgroundColor: 'darkgoldenrod', //data.map((datum) => (datum > 5)? 'green':'darkgoldenrod')
                    borderColor: 'green'
                }]
            },
            options: {
                animation: {
                    duration: 2500
                },
            }
        })
    </script>
</body>

</html>