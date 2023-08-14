<?php load_partial('header'); ?>
<div class="container">
    <div class="card record">
<form action="index.php?controller=Record&action=createRecord" method="post">
    <input type="hidden" name="business_id" value="<?= $business_id ?>">
    <label for="category">类别:</label>
    <select name="category" id="category">
        <option value="income">收入</option>
        <option value="expense">支出</option>
    </select>
    <label for="amount">金额:</label>
    <input type="number" name="amount" id="amount" step="0.01">
    <label for="description">描述:</label>
    <textarea name="description" id="description"></textarea>
    <label for="date">时间:</label>
    <input type="date" name="date" id="date">
    <input type="submit" value="提交经营账目">
</form>
</div></div>
<?php load_partial('footer'); ?>