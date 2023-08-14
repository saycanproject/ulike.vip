<?php load_partial('header'); ?>
<div class="container">
 <h2>重置密码</h2>
 <form method="post" action="index.php?controller=User&action=resetPassword">
     <input type="text" name="username" placeholder="用户">
     <input type="text" name="code" placeholder="重置号码">
     <input type="password" name="password" placeholder="新密码">
     <input type="submit" value="重置密码">
 </form>
</div>
<?php load_partial('footer'); ?>