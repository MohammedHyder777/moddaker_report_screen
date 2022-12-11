<?php
    class User{
        var $username;
        var $name;
        var $type;

        function __construct($un)
        {
            $conn = new mysqli('localhost', 'root', '', 'temp');

            $sql = 'SELECT * FROM users WHERE username="'.$un.'"';

            $result = $conn -> query($sql) -> fetch_all(MYSQLI_ASSOC);
            foreach ($result as $row) {
                $this -> name = $row['name'];
                $this -> type = $row['user_type'] == '2'? 'مستخدم عادي' : 'مدير نظام';
                $this -> username = $row['username'];
            }
        }
    }
?>