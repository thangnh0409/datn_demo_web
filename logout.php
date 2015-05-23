<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/22/15
 * Time: 9:34 AM
 */

session_start();
session_unset();

header("Location: login.php");
exit;

?>