<?php

class DbAuthService
{
    // sfgsf
    var $conn;
    function __construct()
    {
        $this -> conn  = new mysqli('localhost', 'root', '', 'temp');
        $this -> initialize();
    }

    /**
     * Create a new table of  users if there is no one exists.
     */
    protected function initialize(){
        $sql = 'CREATE TABLE IF NOT EXISTS users(
            username VARCHAR(200) PRIMARY KEY NOT NULL,
            name VARCHAR(200) NOT NULL, 
            password VARCHAR(200) NOT NULL, 
            user_type INT)';
        
        $this -> conn -> query($sql);
    }

    function userExists($un){
        $uns_list = [];
        $result = $this -> conn -> query('SELECT username FROM users') -> fetch_all();
        foreach ($result as $row) {
            array_push($uns_list, $row[0]);
        }
        
        return in_array($un, $uns_list);
    }

    function getPassword($un){
        $result = $this -> conn -> query("SELECT password FROM users WHERE username='$un'") -> fetch_all(MYSQLI_ASSOC);
        
        foreach ($result as $row) {
            $dk_pw = $row['password'];
        }
        return $dk_pw;
    }
    function addUser($un, $name, $pw, $isAdmin = false){
        $dk_password = password_hash($pw, PASSWORD_BCRYPT, array('cost' => 14));

        $type = ($isAdmin) ? 1 : 2;
        $stmnt = "INSERT INTO users (username, name, password, user_type)
                VALUES('$un', '$name', '$dk_password', $type)";
        $result = $this -> conn -> query($stmnt);
        if ($result) {
            echo '<p class="messege">أضيف المستخدم لقاعدة البيانات</p>';
        } else {
            echo "ثمت خطأ ما";
        }
    }
    
}
?>