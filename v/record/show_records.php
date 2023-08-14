<?php load_partial('header'); ?>
<div class="container">
<?php
// Get passed records from controller
$records = $data['records'];
$bizname = $records[0]['bizname'];
?>
<h2><?php echo $bizname; ?>经营账目</h2>
<table>
    <tr>
        <th>类别</th>
        <th>金额</th>
        <th>描述</th>
        <th>时间</th>
    </tr>
    <?php foreach ($records as $record): ?>
    <tr>
        <td><?= $record['category'] ?></td>
        <td><?= $record['amount'] ?></td>
        <td><?= $record['description'] ?></td>
        <td><?= $record['date'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<?php load_partial('footer'); ?>