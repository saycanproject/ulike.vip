<?php load_partial('header'); ?>
<div class="container">
<h2>创建经营项目</h2>
<form method="post" action="index.php?controller=Business&action=createBusiness">
    <input type="text" name="bizname" placeholder="项目名称">
    <textarea name="description" placeholder="项目描述"></textarea>
    <input type="number" name="grand_total_target" placeholder="项目目标金额">
    <input type="text" name="handlers" placeholder="账目经手人">
    <label for="min_funding">最少投资金额:</label>
    <input type="number" name="min_funding" id="min_funding" step="0.01">
    <label for="max_funding">最多投资金额:</label>
    <input type="number" name="max_funding" id="max_funding" step="0.01">
    <label for="can_exceed">不受限目标金额?</label>
    <input type="checkbox" name="can_exceed" id="can_exceed">
    <input type="submit" value="创建">
</form>
</div>
<?php load_partial('footer'); ?>