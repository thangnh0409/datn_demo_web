<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/18/15
 * Time: 3:54 PM
 */
include "top_menu.php";
include 'container.php';
include 'left_slidebar.php';

$u_id = $_GET['uid'];
$u_location = $_GET['local'];
$device_model = $_GET['device_model'];
$manufacturer = $_GET['manufacturer'];
?>

<div id="detail_wrapper">
    <div id="detail_title"><h3>Thông tin người dùng</h3></div>
    <div id="user_info">
        <div id="user_avatar">
            <img src="imgs/default-avatar.png" width="170px" height="200px">
        </div>
        <div id="text_info">
            <p>ID người dùng: <?php echo $u_id ?></p>
            <p>Khu vực: <?php echo $u_location ?></p>
            <p>Model thiết bị : <?php echo $device_model ?> </p>
            <p>Nhà sản xuất thiết bị: <?php echo $manufacturer ?> </p>
        </div>
    </div>
</div>


<?php include "footer.php" ?>