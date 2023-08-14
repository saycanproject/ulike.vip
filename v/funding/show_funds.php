<?php load_partial('header'); ?>
<div class="container">
<h2><?php echo $fundings[0]['bizname']; ?>投资明细</h2>
<?php if ($fundings): ?>
    <table>
        <thead>
            <tr>
                <th>投资者</th>
                <th>资金</th>
                <th>日期</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fundings as $funding): ?>
                <tr>
                    <td><?php echo $funding['funder']; ?></td>
                    <td><?php echo $funding['amount']; ?></td>
                    <td><?php echo $funding['date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No funds found.</p>
<?php endif; ?>
</div>
<?php load_partial('footer'); ?>