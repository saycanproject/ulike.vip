<?php load_partial('header'); ?>
<div class="container">
    <h1>Edit Business</h1>
    <form action="index.php?controller=Business&action=editBusiness" method="post">
        <input type="hidden" name="business_id" value="<?= $business['id'] ?>">
        <div class="form-group">
            <label for="bizname">Business Name:</label>
            <input type="text" id="bizname" name="bizname" value="<?= $business['bizname'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?= $business['description'] ?></textarea>
        </div>
        <!-- Include other fields here -->
        <input type="submit" value="Update Business">
    </form>
</div>
<?php load_partial('footer'); ?>