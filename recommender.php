<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/3/15
 * Time: 9:20 AM
 */

include 'top_menu.php';
include 'container.php';

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

echo "<form method='get'>";

echo "<select name='device_id'>";
echo "<option value=\"\">--select device id--</option>";

$selected = mysql_select_db($db_name);
if($selected){
    $sql = "SELECT distinct(device_id) FROM Recommend LIMIT 20";
    $retVal = mysql_query($sql, $conn);
    while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
        echo "<option value=\"{$row['device_id']}\">{$row['device_id']} </option>";
    }
}

echo "</select>";

echo "<input type='submit' name='submit' value='Get Recommendation'/>";

echo "</form>";

echo "<br/><br/><br/><br/><br/>";
if(isset($_GET['device_id'])){
    echo "<table id='tb_res'>";
    echo "<tr>".
        "<th>ID</th>".
        "<th>Adv Name</th>".
        "<th>CTR</th>".
        "</tr>";
    $device_id = $_GET['device_id'];
    $sql = "SELECT A.name, B.ctr FROM link as A, Recommend as B WHERE A.id = B.link_id AND B.device_id = '".$device_id."'";
    $retVal = mysql_query($sql, $conn);
    $i = 0;
    while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
        $i++;
        echo "<tr>".
            "<td>$i</td>".
            "<td>{$row['name']}</td>".
            "<td>{$row['ctr']}</td>".
            "</tr>";
    }
    echo "</table>";
}


mysql_close($conn);

include 'footer.php';
?>


