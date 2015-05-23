<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/15/15
 * Time: 10:00 AM
 */

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "amobi24_03";
$conn = mysql_connect($server_name, $username, $password);
mysql_set_charset('utf8', $conn);
//check connection
if(!$conn){
    die("connect fail: ". $conn->connect_error);
}

$res = array(
    array("Date", "Device")
);
$res1 = array(
    array("Date", "iOS", "Android"),
    array("1/4", 1.5, 0),
    array("2/4", 2, 5),
    array("3/4", 4, 10)
);
if($_POST["device_id"]){
    $ran = rand()%2;
    $device_id = $_POST['device_id'];

    $selected = mysql_select_db($db_name);
    if($selected){
        $sql = "SELECT * FROM `widget_publisher_device` WHERE device_id ='".$device_id."' GROUP BY date";
        $retVal = mysql_query($sql, $conn);
        while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
            $ctr = $row['clicks']/$row['views'];
            $arr = array($row['date'], $ctr);
//            echo $arr;
            array_push($res, $arr);
        }
    }
    echo json_encode($res, JSON_PRETTY_PRINT);
}

?>