<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/4/15
 * Time: 10:36 AM
 */
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "amobi18_05";

$conn = mysql_connect($server_name, $username, $password);
mysql_set_charset('utf8', $conn);
//check connection
if(!$conn){
    die("connect fail: ". $conn->connect_error);
}
?>

<div id="left_slide_bar">
    <h2 class="sl-title">Người dùng</h2>
    <?php
    echo "<select style='width: 150px; margin-left: 20px' id='device_select_box' onchange='changeFunc();'>";
    //echo "<option value=\"\">--select device id--</option>";

    $selected = mysql_select_db($db_name);
    if($selected){
//    $sql = "SELECT device_id, count(date) as count_dv FROM widget_publisher_device GROUP BY device_id HAVING count_dv > 8 LIMIT 20";
        $sql = "SELECT distinct(device_id) from statistic LIMIT 20";
        $retVal = mysql_query($sql, $conn);
        while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
            echo "<option value=\"{$row['device_id']}\">{$row['device_id']} </option>";
        }
    }
    echo "</select>";
    ?>
    <h2 class="sl-title">Nhóm người dùng</h2>
    <ul style="list-style-type:none">
        <li id="ios_user"><img src="imgs/apple.png" width="30" height="30">iOS</li>
        <li id="android_user"><img src="imgs/google_android.png" width="30" height="30">Android</li>
        <li id="wp_user"><img src="imgs/wp.png" width="30" height="30">WinPhone</li>
    </ul>
    <h2 class="sl-title">Khu vực</h2>
    <ul>
        <li>Hà Nội</li>
        <li>TP HCM</li>
    </ul>
</div>