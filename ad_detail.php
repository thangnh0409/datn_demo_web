<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/18/15
 * Time: 9:57 AM
 */

include "top_menu.php";
include 'container.php';
include 'left_slidebar.php';
if(isset($_GET['isPredicate'])){
    $is_predicate = 1;
}else{
    $is_predicate = 0;
}
$ad_name = $_GET['name'];
$rating_value = $_GET['rate_value'];
$ad_size = $_GET['size'];
$ad_cat = $_GET['cat'];

?>

<div id="detail_wrapper">
    <div id="detail_title"><h3>Thông tin quảng cáo</h3></div>
    <div id="ad_info">
        <img src="imgs/ad_test1.png" width="500px" height="70px">
        <p><?php if($is_predicate == 1){ echo "Dự đoán:";} else {echo "Đánh giá:";} ?></p>
        <p>Tên: <?php echo $ad_name ?></p>
        <p>Kích thước: <?php echo $ad_size ?></p>
        <p>Danh mục: <?php echo $ad_cat ?> </p>
    </div>
</div>


<?php include "footer.php" ?>