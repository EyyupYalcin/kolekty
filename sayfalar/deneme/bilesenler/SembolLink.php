<?php
function SembolLink($parametreler){
    ?>
    <div class="card m-7 text-center bg-transparent bg-hover-white text-hover-dark border-0">
        <div class="card-body">
            <a style="color: inherit;" href="<?= $parametreler['link'] ?>">
                <div class="symbol mb-3">
                    <i style="color: inherit;" class="<?= $parametreler['SembolSınıf'] ?> icon-lg icon-4x"></i>
                </div><br>
                <h3><?= $parametreler['etiket'] ?></h3>
            </a>
        </div>
    </div>
    <?php
}
?>