<?php include bilesen('grafiker_card'); ?>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4 mt-2" style="">
    <?php foreach ($grafikerler as $grafiker) {
            ?>
                <div class="col">
                    <?= grafiker_card($grafiker) ?>
                </div>
            <?php
        } ?>
    </div>
</div>