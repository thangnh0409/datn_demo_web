<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/4/15
 * Time: 10:55 AM
 */

include 'top_menu.php';
include 'container.php';
include 'left_slidebar.php';
include 'main_content.php';

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

echo "<select id='device_select_box' onchange='changeFunc();'>";
//echo "<option value=\"\">--select device id--</option>";

$selected = mysql_select_db($db_name);
if($selected){
//    $sql = "SELECT device_id, count(date) as count_dv FROM widget_publisher_device GROUP BY device_id HAVING count_dv > 8 LIMIT 20";
    $sql = "SELECT distinct(device_id) from widget_publisher_device LIMIT 20";
    $retVal = mysql_query($sql, $conn);
    while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
        echo "<option value=\"{$row['device_id']}\">{$row['device_id']} </option>";
    }
}

echo "</select>";

echo "<select id='ad_select_box' onchange='changeFunc();'>";
//echo "<option value=\"\">--select ad--</option>";

$sql = "SELECT distinct(link_id) from widget_publisher_device LIMIT 20";
$retVal = mysql_query($sql, $conn);
while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
    echo "<option value=\"{$row['link_id']}\">{$row['link_id']} </option>";
}

echo "</select>";

include 'footer.php';
?>
