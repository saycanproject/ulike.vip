<?php load_partial('header'); ?>
    <h1>存入资金</h1>
        <form action="http://ulike.vip/index.php?controller=Capital&action=depositCapital&userId=<?php echo $userId; ?>" method="post">
        <label for="amount">金额:</label><br>
        <input type="number" id="amount" name="amount" min="1" required><br>
        <input type="submit" value="存入">
    </form>
<?php load_partial('footer'); ?>