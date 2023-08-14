<?php load_partial('header'); ?>
<div class="container">
<h2>注册</h2>
<form method="post" action="index.php?controller=User&action=register">
    <input type="text" name="username" placeholder="用户" required>
    <input type="email" name="email" placeholder="邮箱" required>
    <input type="password" name="password" placeholder="密码" required>
    <input type="text" name="key" placeholder="注册号" pattern="\d{4}" title="注册好为四位" required>
    <input type="submit" value="注册">
</form>
</div>
<?php load_partial('footer'); ?>