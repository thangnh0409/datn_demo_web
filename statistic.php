<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/4/15
 * Time: 10:55 AM
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
}else {
    $selected = mysql_select_db($db_name);
}
?>
<table id="tb_res">
    <tr>
        <th>Day</th>
        <th>Sum clicks</th>
        <th>Sum views</th>
        <th></th>
    </tr>
    <?php
    $sql = "SELECT sum(clicks) as sum_clicks, sum(views) as sum_views, date FROM `widget_publisher_device` GROUP BY date";
    $retVal = mysql_query($sql, $conn);
    $old_clicks = 0;
    $old_views = 0;
    while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
        echo "<tr>".
            "<td>{$row['date']}</td>";
        if($old_clicks < $row['sum_clicks']){
            $value = $row['sum_clicks'] - $old_clicks;
            echo "<td>{$row['sum_clicks']} <i style='color:blue'>+{$value}</i></td>";
        }else{
            $value = $row['sum_clicks'] - $old_clicks;
            echo "<td>{$row['sum_clicks']} <i style='color:red'>{$value}</i></td>";
        }
        if($old_views < $row['sum_views']){
            $value = $row['sum_views'] - $old_views;
            echo "<td>{$row['sum_views']} <i style='color:blue'>+{$value}</i></td>";
        }else{
            $value = $row['sum_views'] - $old_views;
            echo "<td>{$row['sum_views']} <i style='color:red'>{$value}</i></td>";
        }
        echo "<td><button type='button'>Recommendation</button></td>".
            "</tr>";

        $old_clicks = $row['sum_clicks'];
        $old_views = $row['sum_views'];
    }
    ?>

</table>
<div id="sum_clicks_graph"></div>
<div id="sum_views_graph"></div>
<?php
include 'footer.php';
?>
