<?php load_partial('header'); ?>
<h1>我的可用资金: <?php echo $capital; ?></h1>

<div class="container">
<h2>我已投资项目资金</h2>

<?php if ($fundings): ?>
    <table>
        <thead>
            <tr>
                <th>项目</th>
                <th>金额</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fundings as $funding): ?>
                <tr>
                    <td><?php echo $funding['bizname']; ?></td>
                    <td><?php echo $funding['amount']; ?></td>
                    <td><?php echo $funding['date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>没有找到投入资金.</p>
<?php endif; ?>
</div>
<?php load_partial('footer'); ?>