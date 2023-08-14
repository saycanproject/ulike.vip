<?php load_partial('header'); ?>
<div class="container">
<p>你好, <?php echo $_SESSION['username']; ?>!</p>
<?php
    $roles = explode(',', $_SESSION['role']);
    $status = $_SESSION['status'];
?>
<a href="http://ulike.vip/index.php?controller=Capital&action=showCapital">查看我的资金</a><br>
<?php

    echo '<p><a href="index.php?controller=Business&action=showBusinesses">投资一个项目</a></p>';

    if (in_array('a', $roles)) {
        echo '<p><a href="index.php?controller=User&action=userList">查看编辑用户</a></p>';
    }

    if ($status == 'approved' && in_array('c', $roles)) {
        echo '<p><a href="index.php?controller=Business&action=createBusiness">创建你的项目</a></p>';
    } elseif ($status != 'approved' || !in_array('c', $roles)) {
        echo '<p><a href="index.php?controller=User&action=applyCreateBusiness">创建一个项目 </a></p>';
    } 
?>
</div>
<?php load_partial('footer'); ?>