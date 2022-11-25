<?php include bilesen('diyetisyen_card'); ?>
<div class="container mt-4">
    
    <div class="row">
        <div class="col-md-8">
            <?= $diyetisyen['tanitim'] ?>
        </div>
        <div class="col-md-4">
            <?= diyetisyen_card($diyetisyen) ?>
        </div>
    </div>

</div>