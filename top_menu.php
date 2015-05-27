<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/4/15
 * Time: 10:29 AM
 */

?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
        <link rel="stylesheet" type="text/css" href="css/admin.css">
        <link rel="stylesheet" type="text/css" href="css/filter.css">
        <link rel="stylesheet" type="text/css" href="css/ad_detail.css">
        <link rel="stylesheet" type="text/css" href="css/user_detail.css">
        <script type="text/javascript" src="js/jQuery/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/datepicker/DateRangesWidget.js"></script>
        <script type="text/javascript" src="js/datepicker/datepicker.js"></script>
        <link rel="stylesheet" media="screen" type="text/css" href="css/datepicker/base.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/datepicker/clean.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/DateRangesWidget/base.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/DateRangesWidget/clean.css" />

        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            var chartData;
            $(document).ready(function() {

                $.post("chart_data_ajax.php",
                    {get_sum_clicks_chart: 1},
                    function(data){
                        chartData = $.parseJSON(data);
                        google.setOnLoadCallback(drawSumClicksChart(chartData));
                    });
                $.post("chart_data_ajax.php",
                    {get_sum_views_chart: 1},
                    function(data){
                        chartData = $.parseJSON(data);
                        google.setOnLoadCallback(drawSumViewsChart(chartData));
                    });
                function drawSumClicksChart(chartData) {
                    var data = google.visualization.arrayToDataTable(chartData);

                    var options = {
                        title: 'Clicks statistic',
                        hAxis: {title: 'Ngày',  titleTextStyle: {color: '#333'}},
                        vAxis: {minValue: 0}
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('sum_clicks_graph'));
                    chart.draw(data, options);
                }
                function drawSumViewsChart(chartData) {
                    var data = google.visualization.arrayToDataTable(chartData);

                    var options = {
                        title: 'Views statistic',
                        hAxis: {title: 'Ngày',  titleTextStyle: {color: '#333'}},
                        vAxis: {minValue: 0}
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('sum_views_graph'));
                    chart.draw(data, options);
                }



            });

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+d.toUTCString();
                document.cookie = cname + "=" + cvalue + "; " + expires;
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i=0; i<ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1);
                    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
                }
                return "";
            }
            function changeFunc() {
                var deviceSelectBox = document.getElementById("device_select_box");
//                var adSelectBox = document.getElementById("ad_select_box");
                var device_id = deviceSelectBox.options[deviceSelectBox.selectedIndex].value;
//                var link_id = adSelectBox.options[adSelectBox.selectedIndex].value;
//                setCookie('device_id', selectedValue, 365);
                $.post("test_ajax.php",
                    {device_id: device_id},
                    function(data){
//                        alert(data);
                        chartData = $.parseJSON(data);
                        google.setOnLoadCallback(drawChart(chartData));
                    });
            }
            function drawChart(chartData) {
                var data = google.visualization.arrayToDataTable(chartData);

                var options = {
                    title: 'CTR',
                    hAxis: {title: 'Ngày',  titleTextStyle: {color: '#333'}},
                    vAxis: {minValue: 0}
                };

                var chart = new google.visualization.LineChart(document.getElementById('main_content'));
                chart.draw(data, options);
            }



        </script>
    </head>
    <body>
    <div id="wrapper">
        <div id="header">
            <div id="topMenu">
                <div id="tl-menu">
                    <ul>
                        <li><a href="admincp.php">HOME</a></li>
                        <li><a href="filter.php">Filter</a></li>
                        <li><a href="statistic.php">Statistics</a></li>
                        <li><a href="compare.php">Match</a></li>
                        <li><a href="recommender.php">Recommender</a></li>
                    </ul>
                </div>
                <div id="tr-menu">
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="#">Edit Account</a></li>
                </div>
            </div>
            <div id="title"><h1>Thống kê</h1></div>
<!--            <div id="datepicker-calendar"></div>-->
            <!--<div id="sim-calendar"></div>-->
<!--            <div id="date-range-field"></div>-->
        </div> <!-- end header -->
