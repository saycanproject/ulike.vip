<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/v/partials/style.css">
    <title>又来®投资合作系统【共享-共创-共赢】</title>
</head>
<body>
<div class="container">
<div class="menu container">
<div>
<span> 
    <a href="index.php">主页</a> &nbsp&nbsp 
    <a href="http://ulike.vip/index.php?controller=Business&action=showBusinesses">投资项目</a> &nbsp&nbsp 
    <a href="index.php?controller=User&action=logout">退出</a>
</span>
<?php 
if (isset($_SESSION['logout_message'])) { 
    echo "<div id='logoutMessage'>{$_SESSION['logout_message']}</div>";
    unset($_SESSION['logout_message']);
} 
?>
</div>