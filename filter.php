<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/3/15
 * Time: 9:20 AM
 */

include 'top_menu.php';
include 'container.php';
include 'pagination.php';

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
    $selected = mysql_select_db($db_name);
}

echo "<form method='get'>";

echo "<select name='filter_by'>";
echo "<option value=\"top_clicked_ad\">Top Quảng cáo được click</option>";
echo "<option value=\"top_user_click\">Top Người dùng đã click</option>";
echo "</select>";

echo "<input type='submit' name='submit' value='Filter'/>";

echo "</form>";

echo "<br/><br/><br/><br/><br/>";

if(isset($_GET['filter_by'])){
    $filter_tag = $_GET['filter_by'];
    echo "<table id='tb_res'>";
    if($filter_tag == 'top_clicked_ad'){
        echo "<tr>".
            "<th>ID</th>".
            "<th>Adv Name</th>".
            "<th>Size</th>".
            "<th>Sum clicks</th>".
            "</tr>";
    }else{
        echo "<tr>".
            "<th>ID</th>".
            "<th>UserID</th>".
            "<th>Sum clicks</th>".
            "<th>Sum views</th>".
            "</tr>";
    }

    $page = 1;
    $limit = 10;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    $offset = ($page-1)*$limit;
    $i = $offset;
    if($filter_tag == 'top_clicked_ad'){
        $sql = "SELECT name, widthBanner, heightBanner, sum_clicks FROM top_clicked_ad order by sum_clicks desc LIMIT $limit OFFSET $offset";
        $retVal = mysql_query($sql, $conn);
        while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
            $i++;
            $size = $row['widthBanner'].'x'.$row['heightBanner'];
            $link = "ad_detail.php?name=".$row['name']."&rate_value=3&size=".$size."&cat=edu";
            echo "<tr>".
                "<td>$i</td>".
                "<td><a href={$link}>{$row['name']}</a></td>".
                "<td>{$size}</td>".
                "<td>{$row['sum_clicks']}</td>".
                "</tr>";
        }
    }else if($filter_tag == 'top_user_click'){
        $sql = "SELECT device_id, sum_click, sum_views FROM top_user_click ORDER BY sum_click DESC LIMIT $limit OFFSET $offset";
        $retVal = mysql_query($sql, $conn);
        while($row = mysql_fetch_array($retVal, MYSQL_ASSOC)){
            $i++;
            $link = "user_detail.php?uid={$row['device_id']}&local=HaNoi&os=iOS&gender=male";
            echo "<tr>".
                "<td>$i</td>".
                "<td><a href={$link}>{$row['device_id']}</a></td>".
                "<td>{$row['sum_click']}</td>".
                "<td>{$row['sum_views']}</td>".
                "</tr>";
        }
    }

    echo "</table>";

    //Pagination
    $config = array(
        'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
        'total_record'  => 50, // Tổng số record
        'limit'         => $limit,// limit
        'link_full'     => $_GET['filter_by'] == 'top_clicked_ad' ? 'filter.php?filter_by=top_clicked_ad&page={page}' : 'filter.php?filter_by=top_user_click&page={page}',
        'link_first'    => $_GET['filter_by'] == 'top_clicked_ad' ? 'filter.php?filter_by=top_clicked_ad&page=1' : 'filter.php?filter_by=top_user_click&page=1',
    );

    $paging = new Pagination();

    $paging->init($config);

    echo $paging->html();
}
mysql_close($conn);

include 'footer.php';
?>


