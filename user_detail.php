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
$os_device = $_GET['os'];
$u_gender = $_GET['gender'];

?>

<div id="detail_wrapper">
    <div id="detail_title"><h3>Thông tin người dùng</h3></div>
    <div id="user_info">
        <div id="user_avatar">
            <img src="imgs/default-avatar.png" width="170px" height="200px">
        </div>
        <div id="text_info">
            <p>User ID: <?php echo $u_id ?></p>
            <p>Khu vực: <?php echo $u_location ?></p>
            <p>Giới tính : <?php echo $u_gender ?> </p>
            <p>OS Device : <?php echo $os_device ?> </p>
        </div>
    </div>
</div>


<?php include "footer.php" ?>