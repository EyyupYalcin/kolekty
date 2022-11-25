<?php include bilesen('grafiker_card'); ?>
<div class="container mt-4">
    
    <div class="row">
        <div class="col-md-8">
            <?= $grafiker['tanitim'] ?>
        </div>
        <div class="col-md-4">
            <?= grafiker_card($grafiker) ?>
        </div>
    </div>

</div>