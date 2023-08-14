<?php 
load_partial('header'); ?>
<div class="container">
<div class="card funding">
<h2 style="color: #3498db;">投资此项目</h2>
<form method="post" action="index.php?controller=Funding&action=fundBusiness">
    <input type="hidden" name="business_id" value="<?php echo $business['id']; ?>">
    <?php
    $extra_info = json_decode($business['extra_info'], true);
    $min_funding = $extra_info['min_funding'] ?? 0;
    $max_funding = $extra_info['max_funding'] ?? 0;
    $grand_total_target = is_numeric($extra_info['grand_total_target']) ? $extra_info['grand_total_target'] : 0;
    $can_exceed = $extra_info['can_exceed'] ?? 0;
    $total_funds = is_numeric($total_funds) ? $total_funds : 0;
    $available_funding = $can_exceed ? '不限' : max(0, $grand_total_target - $total_funds);
    ?>
    <p>项目总金额: <?php echo $grand_total_target; ?></p>
    <p>可投入金额: <?php echo $available_funding; ?></p>
    <p>最低投资金额: <?php echo $min_funding; ?></p>
    <p>最高投资金额: <?php echo $max_funding; ?></p>
    <input type="hidden" name="min_funding" value="<?php echo $min_funding; ?>">
    <input type="hidden" name="max_funding" value="<?php echo $max_funding; ?>">
    <input type="number" step="0.01" name="amount" placeholder="金额">
    <input type="submit" value="投入" onclick="return confirm('请确认！');">
</form>
</div></div>
<?php load_partial('footer'); ?>