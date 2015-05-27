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
}else{
    $selected = mysql_select_db($db_name);
}

$res = array(
    array("Date", "Actual","Predict")
);
if(isset($_POST["device_id"])){
    $ran = rand()%2;
    $device_id = $_POST['device_id'];
//    $link_id = $_POST['link_id'];
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

if(isset($_POST['get_sum_clicks_chart'])){
    $res1 = array(
        array("Date", "clicks"),
    );
    $sql = "SELECT sum(clicks) as sum_clicks, date FROM `widget_publisher_device` GROUP BY date";
    $retVal = mysql_query($sql, $conn);
    while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
        $arr = array($row['date'], intval($row['sum_clicks']));
        array_push($res1, $arr);
    }
    echo json_encode($res1, JSON_PRETTY_PRINT);
}
if(isset($_POST['get_sum_views_chart'])){
    $res1 = array(
        array("Date", "views"),
    );
    $sql = "SELECT sum(views) as sum_views, date FROM `widget_publisher_device` GROUP BY date";
    $retVal = mysql_query($sql, $conn);
    while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
        $arr = array($row['date'], intval($row['sum_views']));
        array_push($res1, $arr);
    }
    echo json_encode($res1, JSON_PRETTY_PRINT);
}
?>