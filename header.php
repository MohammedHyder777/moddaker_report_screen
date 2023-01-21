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
        <li><a href='#'  role="button" onclick="toggleFullscreen()" id="fullscreen">O</a></li>
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
            
        }),
    )

    function openFullscreen(id) {
        var elem = document.getElementById(id);
        
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) { /* For IE 11 */
            elem.msRequestFullscreen();
        } else if (elem.webkitRequestFullscreen){ /* For Safari */
            elem.webkitRequestFullscreen();
        }
    }
    function closeFullscreen() {
        
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) { /* For IE 11 */
            document.msExitFullscreen();
        } else if (document.webkitExitFullscreen){ /* For Safari */
            document.webkitExitFullscreen();
        }


    }

    function toggleFullscreen(id) {
        if (document.fullscreenElement === null) {
            openFullscreen(id);
        } else {
            closeFullscreen(id);
        }
    }
</script>

