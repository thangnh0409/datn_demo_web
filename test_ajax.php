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
//    $link_id = $_POST['link_id'];
    $selected = mysql_select_db($db_name);
    if($selected){
        $sql = "SELECT * FROM `statistic` WHERE device_id ='".$device_id."' GROUP BY date";
//        echo $sql;
        $retVal = mysql_query($sql, $conn);
        while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){

            $actual_ctr = $row['actual_ctr'];
            $predict = $row['predict_ctr'];
            $predict = floatval($predict);
            if($predict < 0) $predict = 0;
            $arr = array($row['date'], floatval($actual_ctr), $predict);
//            echo $arr;
            array_push($res, $arr);
        }
    }
    echo json_encode($res, JSON_PRETTY_PRINT);
}

?>