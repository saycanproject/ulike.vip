<?php load_partial('header'); ?>
<div class="container">
<!-- <h2>平台项目</h2> -->
<?php if ($otherBusinesses): ?>
    <ul>
    <?php foreach ($otherBusinesses as $business): ?>
        <li>
            <h3><?php echo $business['bizname']; ?></h3>
            <!-- Keep the existing link to fund the business -->
            <a href="index.php?controller=Funding&action=fundBusiness&business_id=<?php echo $business['id']; ?>">投资此项目</a>
            <a href="index.php?controller=Balance&action=showBalance&business_id=<?php echo $business['id']; ?>">此项目收益</a>
            <a href="index.php?controller=Funding&action=showFundsByBusiness&business_id=<?php echo $business['id']; ?>">所有投资金</a>
            <?php if (isset($business['json_options']) && $business['json_options'] !== false && $business['isApprovedCandidate']): ?>
                <a href="index.php?controller=Record&action=createRecord&business_id=<?php echo $business['id']; ?>">添加经营账目</a>
            <?php endif; ?>
            <?php if (isset($roles) && in_array('a', $roles) || $business['isApprovedCandidate']) : ?>
                <a href="index.php?controller=Record&action=showRecords&business_id=<?php echo $business['id']; ?>">查看经营账目</a>
            <?php endif; ?>   
            <?php if (isset($roles) && in_array('a', $roles)) : ?>
                <a href="index.php?controller=Business&action=editBusiness&business_id=<?php echo $business['id']; ?>">编辑此项目</a>
            <?php endif; ?>   
            <p>
                <?php 
                $description = $business['description'];
                $description_length = 100; // The number of characters to display initially
                if (mb_strlen($description, 'UTF-8') > $description_length) {
                    $visible_text = mb_substr($description, 0, $description_length, 'UTF-8');
                    $hidden_text = mb_substr($description, $description_length, mb_strlen($description), 'UTF-8');
                    echo $visible_text . '<span class="hidden">' . $hidden_text . '</span><span class="read-more-button">全文</span>';
                } else {
                    echo $description;
                }
                ?>
            </p>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($businesses): ?>
    <h2>我的项目</h2>
    <ul>
    <?php foreach ($businesses as $business): ?>
        <li>
            <h3><?php echo $business['bizname']; ?></h3>
            <!-- Keep the existing link to fund the business -->
            <a href="index.php?controller=Funding&action=fundBusiness&business_id=<?php echo $business['id']; ?>">投资此项目</a>
            <a href="index.php?controller=Balance&action=showBalance&business_id=<?php echo $business['id']; ?>">此项目收益</a>
            <a href="index.php?controller=Funding&action=showFundsByBusiness&business_id=<?php echo $business['id']; ?>">所有投资金</a>
            <?php if (isset($business['json_options']) && $business['json_options'] !== false && $business['isApprovedCandidate']): ?>
                <a href="index.php?controller=Record&action=createRecord&business_id=<?php echo $business['id']; ?>">添加经营账目</a>
            <?php endif; ?>
            <?php if (isset($roles) && in_array('a', $roles) || $business['isApprovedCandidate']) : ?>
                <a href="index.php?controller=Record&action=showRecords&business_id=<?php echo $business['id']; ?>">查看经营账目</a>
            <?php endif; ?> 
            <?php if (isset($roles) && in_array('a', $roles)) : ?>
                <a href="index.php?controller=Business&action=editBusiness&business_id=<?php echo $business['id']; ?>">编辑此项目</a>
            <?php endif; ?>          
            <p>
                <?php 
                $description = $business['description'];
                $description_length = 100; // The number of characters to display initially
                if (mb_strlen($description, 'UTF-8') > $description_length) {
                    $visible_text = mb_substr($description, 0, $description_length, 'UTF-8');
                    $hidden_text = mb_substr($description, $description_length, mb_strlen($description), 'UTF-8');
                    echo $visible_text . '<span class="hidden">' . $hidden_text . '</span><span class="read-more-button">全文</span>';
                } else {
                    echo $description;
                }
                ?>
            </p>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>
<script>
    function getPreviousElementSibling(element) {
        do {
            element = element.previousSibling;
        } while (element && element.nodeType !== 1);
        return element;
    }
    window.onload = function() {
        var buttons = document.getElementsByClassName("read-more-button");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function() {
                var hiddenText = getPreviousElementSibling(this);
                if (hiddenText.style.display === "none") {
                    hiddenText.style.display = "inline";
                    this.textContent = "简介";
                } else {
                    hiddenText.style.display = "none";
                    this.textContent = "全文";
                }
            });
        }
    };
</script>
<?php load_partial('footer'); ?>