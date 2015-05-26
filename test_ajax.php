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
$db_name = "amobi18_05";
$conn = mysql_connect($server_name, $username, $password);
mysql_set_charset('utf8', $conn);
//check connection
if(!$conn){
    die("connect fail: ". $conn->connect_error);
}

$res = array(
    array("Date", "Actual","Predict")
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
    $link_id = $_POST['link_id'];
    $link_id = 891;
    $selected = mysql_select_db($db_name);
    if($selected){
        $sql = "SELECT sum(clicks) as clicks, sum(views) as views, date FROM `widget_publisher_device` WHERE device_id ='".$device_id."' AND link_id = ".$link_id." GROUP BY date";
//        echo $sql;
        $retVal = mysql_query($sql, $conn);
        while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
            $sql = "SELECT ctr FROM daily_predict WHERE device_id = '".$device_id."' AND link_id = '".$link_id."' AND date = '".$row['date']."'";
            $retVal1 = mysql_query($sql, $conn);
            $row1 = mysql_fetch_row($retVal1);
            if($row1){
                $predict = $row1[0];
            }else{
                $predict = 0;
            }
            $ctr = $row['clicks']/$row['views'];
            $arr = array($row['date'], $ctr, $predict);
//            echo $arr;
            array_push($res, $arr);
        }
    }
    echo json_encode($res, JSON_PRETTY_PRINT);
}

?>