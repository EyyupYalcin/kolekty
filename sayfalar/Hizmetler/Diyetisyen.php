<?php include bilesen('diyetisyen_card'); ?>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4 mt-2" style="">
    <?php foreach ($diyetisyenler as $diyetisyen) {
            ?>
                <div class="col">
                    <?= diyetisyen_card($diyetisyen) ?>
                </div>
            <?php
        } ?>
    </div>
</div>