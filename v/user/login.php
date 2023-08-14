<?php load_partial('header'); ?>
<div class="container">
<h2>登录</h2>
<form method="post" action="index.php?controller=User&action=login">
    <input type="text" name="username" placeholder="用户">
    <input type="password" name="password" placeholder="密码">
    <input type="submit" value="登录">
</form>

<?php
if (isset($_SESSION['error'])) {
    echo "<p>Error: " . $_SESSION['error'] . "</p>";
    if ($_SESSION['error'] == "该用户不存在.") {
        echo '<p><a href="index.php?controller=User&action=register">注册</a></p>';
    }
    if ($_SESSION['error'] == "密码错误.") {
        echo '<p><a href="index.php?controller=User&action=resetPasswordRequest">重置密码</a></p>';
    }
    unset($_SESSION['error']);
}
?>
</div>
<?php load_partial('footer'); ?>