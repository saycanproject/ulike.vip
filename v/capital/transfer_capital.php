<?php load_partial('header'); ?>
    <h1>Withdraw Capital</h1>
    <form action="http://ulike.vip/index.php?controller=Capital&action=transferCapital" method="post">
        <label for="amount">Amount:</label><br>
        <input type="number" id="amount" name="amount" min="1" required><br>
        <input type="submit" value="Withdraw Funds">
    </form>
<?php load_partial('footer'); ?>