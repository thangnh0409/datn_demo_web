<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/20/15
 * Time: 8:36 AM
 */

session_start();

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "amobi24_03";

$conn = mysql_connect($server_name, $username, $password);
mysql_set_charset('utf8', $conn);
//check connection
if(!$conn){
    die("connect fail: ". $conn->connect_error);
}else{
    mysql_select_db($db_name);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login to System</title>
    <link rel="stylesheet" href="css/authen.css" type="text/css" />
</head>
<body>
    <div id="notifi">
        <?php
            if(!empty($_SESSION['isLoggedIn']) && !empty($_SESSION['username'])){
                header('Location: admincp.php');
                exit;
            }elseif(!empty($_POST['username']) && !empty($_POST['password'])){
                $username = mysql_real_escape_string($_POST['username']);
                $password = md5(mysql_real_escape_string($_POST['password']));
                $checklogin = mysql_query("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'");
                if(mysql_num_rows($checklogin) == 1){
                    $row = mysql_fetch_array($checklogin);
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['isLoggedIn'] = 1;
                }else{
                    //login fail
                    echo "Incorrect username or password!";
                }
            }
        ?>
    </div>
    <div id="form-title">
        <p><label for="form-title">Đăng nhập vào hệ thống</label></p>
    </div>
    <div id="login-box">
        <form action="" method="POST" id="loginform">
            <p>
                <label for="user_login">Username<br>
                <input type="text" name="username" id="user_login" class="input" value="" size="20"></label>
            </p>
            <p>
                <label for="user_pass">Password<br>
                    <input type="password" name="password" id="user_pass" class="input" value="" size="20"></label>
            </p>
            <p class="forgetmenot">
                <label for="rememberme">
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever">
                    Remember Me
                </label>
            </p>
            <p class="submit">
                <input type="submit" name="submit" id="submit-btn" class="login-btn" value="Log In">
            </p>
        </form>
    </div>
</body>
</html>