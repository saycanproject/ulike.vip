<?php load_partial('header'); ?>
<div class="container">
<h2>Password Recovery</h2>
<form method="post" action="index.php?controller=User&action=resetPasswordRequest">
    <input type="text" name="username" placeholder="用户">
    <input type="submit" value="重置密码">
</form>
</div>
<?php load_partial('footer'); ?>
