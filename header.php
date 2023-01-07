<style>
    #mymodal{
        display: block;
        background-color: red;
    }
</style>

<nav>
    <ul>
        <li><a href="home.php">الرئيسة</a></li>
        <li><a href="reports_screen2.php">التقارير</a></li>
        <li><a href="manage_users.php">إدارة المستخدمين</a></li>
        <li><a href="logout.php" style="float:left;">خروج</a></li>
        <li><a href='#'  class="opener" style="float:left;">نافذة عائمة</a></li>
    </ul>
</nav>

<br>

<!-- The content of the modal -->
<div id="mymodal">
    <p>هذه نافذة عائمة</p>
</div>

<script type='text/javascript' src='/jquery/jquery-3.6.1.min.js'></script>

<script>
    $(document).ready(
        $('nav li a').each(function () {
            if (this.href == document.URL.split('?')[0]) {
                this.style.backgroundColor = '#067029'
            }
        }),
        $('.opener').click(function () {
            var modal = document.getElementById('mymodal')


            modal.style.display = modal.style.display == 'none'? 'block' : 'none'
            
        })
    )
</script>

