<nav>
    <ul>
        <li><a href="home.php">الرئيسة</a></li>
        <li><a href="reports_screen.php">التقارير</a></li>
        <li><a href="logout.php" style="float:left;">خروج</a></li>
    </ul>
</nav>

<br>

<script type='text/javascript' src='/jquery/jquery-3.6.1.min.js'></script>

<script>
    $(document).ready(
        $('nav li a').each(function () {
            if (this.href == document.URL.split('?')[0]) {
                this.style.backgroundColor = '#067029'
            }
        })
    )
</script>