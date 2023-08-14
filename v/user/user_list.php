<?php load_partial('header'); ?>
<div class="container">
<h2>User List</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Role</th>
        <th>Apply Status</th>
        <th>Apply Time</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user) : ?>
    <?php
    if (is_string($user['options'])) {
        $options = json_decode($user['options'], true);
        if (is_array($options) && isset($options['applyCreateBusiness'])) {
            $applyStatus = isset($options['applyCreateBusiness']['status']) ? $options['applyCreateBusiness']['status'] : null;
            $applyTime = isset($options['applyCreateBusiness']['timestamp']) ? $options['applyCreateBusiness']['timestamp'] : null;
        } else {
            // Handle the case where $options is not an array or doesn't contain the 'applyCreateBusiness' key
            $applyStatus = null;
            $applyTime = null;
        }
    } else {
        // Handle the case where $user['options'] is not a string
        $options = null;
        $applyStatus = null;
        $applyTime = null;
    }
    
    ?>    
        <tr>
            <form action="index.php?controller=User&action=updateUser" method="post">
                <td>
                    <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
                    <?php echo $user['username']; ?>
                </td>
                <td>
                    <select name="status">
                        <?php
                        $statuses = ['pending', 'approved', 'rejected'];
                        foreach ($statuses as $status) {
                            if ($status === $user['status']) {
                                echo "<option value='$status' selected>$status</option>";
                            } else {
                                echo "<option value='$status'>$status</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="role" value="<?php echo $user['role']; ?>">
                </td>
                
                <td>
                    <?php echo $applyStatus ?>
                </td>
                <td>
                    <?php echo $applyTime ?>
                </td>
                <td>
                    <input type="submit" value="Update User">
                    <a href="http://ulike.vip/index.php?controller=Capital&action=depositCapital&userId=<?php echo $user['id']; ?>">Deposit Capital</a>                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>
</div>
<?php load_partial('footer'); ?>